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
        $trivia = Puntaje::where('available', 0)->where('time_finish', null)->get();

        $response = array(
            'code' => 401,
            'status' => 'expirated'
        );

        if($trivia->isNotEmpty()){
            $response['data']['message'] = 'Termina tu otra trivia antes de pedir otro juego.';
            return $response;
        }

        if ($now->diffInDays(new Carbon($ciudad->publish)) <= 2) {

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

        $puntaje = Puntaje::with('trivia.preguntas.respuestas')->where('available', 0)->where('time_finish', null)->get();

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

        $puntaje[0]->time_start = Carbon::now();
        $puntaje[0]->save();

        return array(
            'code' => 200,
            'status' => 'success',
            'data' => array(
                'preguntas' => $data
            ));
    }

    public function stopGame($id)
    {
        return array(
            'code' => 200,
            'status' => 'success',
            'data' => array(

            )
        );
    }

}
