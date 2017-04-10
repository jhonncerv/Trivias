<?php
/**
 * Created by PhpStorm.
 * User: migcerva
 * Date: 4/9/17
 * Time: 2:23 p.m.
 */

namespace App\Http\Controllers;

use App\Intento;
use App\Puntaje;
use App\Trivia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TriviaConnect
{

    function __construct()
    {
    }

    public function giveMeTrivia($id)
    {
        $trivias = Trivia::where('available', 1)->get();
        $participa= Auth::user()->participante[0];
        $response = array(
            'code' => 401,
            'status' => 'error'
        );


        foreach ($trivias as $trivia){

            $tiempo_puntaje = Puntaje::firstOrCreate([
                'trivia_id' => $trivia->id,
                'ciudad_id' => $id,
                'participante_id' => $participa->id
            ])->time_finish;

            if($tiempo_puntaje !== null){

                $diff = new Carbon($tiempo_puntaje, 'America/Mexico_City');
                $tim = $diff->diffInMinutes(Carbon::now('America/Mexico_City'));

                if( $tim < 5){
                    $response['message'] = 'No te desesperes, el siguiente juego estará disponible en ' . (5 -$tim) . ' minutos.';
                    return $response;
                }

            }
        }

        $puntaje = $participa->puntajes()->where('available', 1)->where('ciudad_id', $id)->get();

        if($puntaje->isNotEmpty()){
            $puntaje = $puntaje->random();
            $puntaje->available = 0;
            $puntaje->save();
            $response = array(
                'code' => 200,
                'status' => 'success',
                'data' => array(
                    'type' => $puntaje->trivia->game
                ));
            return $response;
        }

        $response['message'] = 'Ya no quedan juegos disponibles.';
        return $response;
    }


    /**
     * Todo: validacion si te desconectas
     * @param $puntaje
     * @return array
     */
    public function startMeTrivia($puntaje)
    {

        $query = $puntaje->trivia->query_size;
        $preguntas = $puntaje->trivia->preguntas;
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
                'pregunta_id' => $preguntas[$numbers[$i] - 1]->id,
                'puntaje_id' => $puntaje->id,
            ]);

            foreach ($preguntas[$numbers[$i] - 1]->respuestas as $respuesta){
                $t++;
                $id_res = str_random(9);

                $resp[$t] = array('id' => $id_res, 'option' => $respuesta->option);

                if($respuesta->correct == 1){
                    $intento->respuesta_id = $respuesta->id;
                    $intento->correct_str = $id_res;
                }
            }

            if($intento->correct_str == null){
                return $intento;
            }

            $intento->save();


            $pre_data = [
                'id' => $id_preg,
                'pregunta' => $preguntas[$numbers[$i] - 1]->question,
                'respuestas' => $resp
            ];

            if($puntaje->trivia->id == 1)
            {
                $contents = Storage::get($preguntas[$numbers[$i] - 1]->question);
                //$imagedata = file_get_contents($file);
                $base64 = base64_encode($contents);
                $pre_data['pregunta'] = 'data:image/gif;base64,'.$base64;
            }
            if($puntaje->trivia->id == 2)
            {
                $contents = Storage::get($preguntas[$numbers[$i] - 1]->question);
                $base64 = base64_encode($contents);
                $pre_data['pregunta'] = 'data:image/gif;base64,'.$base64;
                $pre_data['caption'] = $preguntas[$numbers[$i] - 1]->caption;
            }

            $data = array_add( $data, $i, $pre_data);

        }

        $puntaje->time_start = Carbon::now('America/Mexico_City');
        $puntaje->save();

        return array(
            'code' => 200,
            'status' => 'success',
            'data' => array(
                'servertime' => round( microtime(true) * 1000 ),
                'endtime' => round( microtime(true) * 1000 ) + 2 * 60 * 1000,
                'preguntas' => $data
            ));
    }

    public function stopMeTrivia($participa, $puntaje, $data)
    {
        $datenow = Carbon::now('America/Mexico_City');
        $puntaje->time_finish = $datenow->toDateTimeString();
        $inicio = new Carbon($puntaje->time_start, 'America/Mexico_City');

        $valor_pregunta = $puntaje->trivia->points_per_anwser;
        $factor = $puntaje->trivia->time_limit - $inicio->diffInSeconds($datenow);
        $porfac = $factor > 0 ? ($factor / $puntaje->trivia->time_limit) : 0;


        $intentos = $puntaje->intentos;
        $puntos = 0;
        foreach ($intentos as $intento) {
            foreach ($data as $dat){
                if($intento->query_ord == $dat['id']){
                    $intento->attempt_str = $dat['option'];
                    if($intento->correct_str == $dat['option']){
                        $puntos++;
                    }
                    $intento->save();
                }
            }
        }

        $puntaje->query_score = $puntos * $valor_pregunta;
        $puntaje->punish_factor = $porfac;
        $puntaje->total_score = floor($puntos * $valor_pregunta * $porfac);

        $participa->points = floor($participa->points + $puntaje->total_score);
        $participa->save();

        $puntaje->save();
        return array(
            'code' => 200,
            'status' => 'success',
            'data' => array(
                'score_dynamic' => $puntaje->query_score,
                'score_time' => $puntaje->total_score,
                'score_new' => $participa->points
            )
        );
    }

    public function continuMeTrivia($intentos, $trivia_id)
    {
        $data = [];
        $t = -1;
        foreach ($intentos as $intento){
            $t++;

            $intento->query_ord = str_random(9);

            $resp = [];
            $r = -1;

            foreach ($intento->pregunta->respuestas as $respuesta) {

                $r++;
                $id_res = str_random(9);
                $resp[$r] = array('id' => $id_res, 'option' => $respuesta->option);
                if($respuesta->correct == 1){
                    $intento->correct_str = $id_res;
                }
            }

            $data = array_add( $data, $t, [
                'id' => $intento->query_ord,
                'pregunta' => $intento->pregunta->question,
                'respuestas' => $resp
            ]);

            $intento->save();



            $pre_data = [
                'id' => $intento->query_ord,
                'pregunta' => $intento->pregunta->question,
                'respuestas' => $resp
            ];

            if($trivia_id == 2)
            {
                $contents = Storage::get($intento->pregunta->question);
                //$imagedata = file_get_contents($file);
                $base64 = base64_encode($contents);
                $pre_data['pregunta'] = 'data:image/gif;base64,'.$base64;
                $pre_data['caption'] = $intento->pregunta->caption;
            }

            $data = array_add( $data, $t, $pre_data);

        }
        return $data;
    }

}