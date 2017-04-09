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

class TriviaConnect
{

    function __construct()
    {
    }

    public function giveMeTrivia($id)
    {
        $trivias = Trivia::all();
        $participa= Auth::user()->participante[0];

        $response = array(
            'code' => 401,
            'status' => 'error',
            'mesage' => 'Ya no quedan juegos disponibles'
        );

        foreach ($trivias as $trivia){
            Puntaje::firstOrCreate([
                'trivia_id' => $trivia->id,
                'ciudad_id' => $id,
                'participante_id' => $participa->id
            ]);
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
        }
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
                'pregunta_id' => $preguntas[$numbers[$i]]->id,
                'puntaje_id' => $puntaje->id,
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

        $puntaje->time_start = Carbon::now('America/Mexico_City');
        $puntaje->save();

        return array(
            'code' => 200,
            'status' => 'success',
            'data' => array(
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
        $puntaje->total_score = $puntos * $valor_pregunta * $porfac;

        $participa->points = $participa->points + $puntaje->total_score;
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

    public function continuMeTrivia($intentos)
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

        }
        return $data;
    }

}