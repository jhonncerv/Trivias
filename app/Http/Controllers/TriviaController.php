<?php

namespace App\Http\Controllers;

use App\Ciudad;
use App\Intento;
use App\Participante;
use App\Puntaje;
use App\Trivia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TriviaController extends Controller
{
    public function index()
    {
        $trivia = Trivia::all();
        return $trivia;
    }

    public function todayGame($id)
    {
        $now = Carbon::now('America/Mexico_City');
        $ciudad = Ciudad::find($id);
        $trivia = Puntaje::where('available', 0)->where('time_finish', null)->where('participante_id', Auth::user()->participante[0]->id)->get();

        $response = array(
            'code' => 401,
            'status' => 'expirated'
        );

        if($trivia->isNotEmpty()){
            $response['data']['message'] = 'Termina tu otra trivia antes de pedir otro juego.';
            return $response;
        }

        if ($now->diffInDays(new Carbon($ciudad->publish,'America/Mexico_City')) <= 2) {

            $trivias = Trivia::all();
            $participa= Auth::user()->participante[0];

            foreach ($trivias as $trivia){
                Puntaje::firstOrCreate([
                    'trivia_id' => $trivia->id,
                    'ciudad_id' => $id,
                    'participante_id' => $participa->id
                ]);
            }

            /* Todo: validacion si te desconectas */

            $puntaje = $participa->puntajes()->where('available', 1)->where('ciudad_id', $id)->get();

            if($puntaje->isNotEmpty()){
                $puntaje = $puntaje->random();
                $puntaje->available = 0;
                $puntaje->save();
                $response = array(
                    'code' => 200,
                    'status' => 'success',
                    'data' => array(
                    'trivia' => $puntaje->trivia
                ));

            } else {
                $response['mesage'] = 'Ya no quedan juegos disponibles';
            }

            return $response;

        }

        $response['data']['message'] = 'Ciudad no disponible.';
        return $response;
    }

    public function startGame()
    {

        $puntaje = Puntaje::with('trivia.preguntas.respuestas')
                            ->where('available', 0)
                            ->where('participante_id', Auth::user()->participante[0]->id)
                            ->where('time_finish', null)->get();

        if($puntaje->isEmpty()){
            return array(
                'code' => 401,
                'status' => 'unauthorized',
                'message' => 'Aun no has iniciado ninguna trivia.');
        }
        if($puntaje[0]->time_start !== null){
            return array(
                'code' => 401,
                'status' => 'unauthorized',
                'message' => 'Termina la trivia antes de iniciar otra');
        }
        $query = $puntaje[0]->trivia->query_size;
        $preguntas = $puntaje[0]->trivia->preguntas;

        /* Todo: Pasar a trivia */

        $numbers = range(1, $preguntas->count());
        shuffle($numbers);
        array_slice($numbers, 0, $query);

        $data = [];

        for($i = 0; $i < $query; $i++){
            $id_preg = str_random(9);
            $resp = [];
            $t = -1;
            $intento = new Intento([
                'query_ord' => $id_preg,
                'pregunta_id' => $preguntas[$numbers[$i]]->id,
                'puntaje_id' => $puntaje[0]->id,
            ]);

            foreach ($preguntas[$numbers[$i]]->respuestas as $respuesta){
                $t++;
                $id_res = str_random(9);
                $resp[$t] = array('id' => $id_res, 'option' => $respuesta->option);
                if($respuesta->correct == 1){
                    $intento->respuesta_id = $respuesta->id;
                    $intento->correct_str = $id_res;
                }
            }

            $intento->save();

            $data = array_add( $data, $i, [
                'id' => $id_preg,
                'pregunta' => $preguntas[$numbers[$i]]->question,
                'respuestas' => $resp
            ]);
        }

        $puntaje[0]->time_start = Carbon::now('America/Mexico_City');
        $puntaje[0]->save();

        return array(
            'code' => 200,
            'status' => 'success',
            'data' => array(
                'preguntas' => $data
            ));
    }

    public function stopGame(Request $request)
    {
        $participa = Auth::user()->participante[0];
        $puntaje = Puntaje::with('intentos', 'trivia')
                ->where('available', 0)
                ->where('participante_id', $participa->id)
                ->where('time_finish', null)
                ->where('time_start', '<>', null)
                ->get();

        if($puntaje->isEmpty()){
            return array(
                'code' => 401,
                'status' => 'unauthorized',
                'message' => 'Aun no has iniciado ninguna trivia.');
        }
        $datenow = Carbon::now('America/Mexico_City');
        $puntaje[0]->time_finish = $datenow->toDateTimeString();
        $inicio = new Carbon($puntaje[0]->time_start, 'America/Mexico_City');

        $valor_pregunta = $puntaje[0]->trivia->points_per_anwser;
        $factor = $puntaje[0]->trivia->time_limit - $inicio->diffInSeconds($datenow);
        $porfac = $factor > 0 ? ($factor / $puntaje[0]->trivia->time_limit) : 0;


        $intentos = $puntaje[0]->intentos;
        $data = $request->data;
        $puntos = 0;
        foreach ($intentos as $intento) {
            foreach ($data as $dat){

                if($intento->query_ord == $dat['id']){
                    $intento->attempt_str = $dat['v'];
                    if($intento->correct_str == $dat['v']){
                        $puntos++;
                    }
                    $intento->save();
                }
            }
        }

        $puntaje[0]->query_score = $puntos * $valor_pregunta;
        $puntaje[0]->punish_factor = $porfac;
        $puntaje[0]->total_score = $puntos * $valor_pregunta * $porfac;

        $participa->points = $participa->points + $puntaje[0]->total_score;
        $participa->save();

        $puntaje[0]->save();
        return array(
            'code' => 200,
            'status' => 'success',
            'data' => array(
                'puntaje' => $puntaje[0]->total_score,
                'total' => $participa->points
            )
        );
    }

}
