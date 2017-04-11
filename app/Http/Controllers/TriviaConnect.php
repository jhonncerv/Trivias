<?php
/**
 * Created by PhpStorm.
 * User: migcerva
 * Date: 4/9/17
 * Time: 2:23 p.m.
 */

namespace App\Http\Controllers;

use App\Ciudad;
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

                if( $tim < 15){
                    $response['message'] = 'No te desesperes, el siguiente juego estará disponible en ' . (15 -$tim) . ' minuto'.($tim == 4 ? '':'s').'.';
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

        $response['message'] = 'Ya no quedan juegos disponibles para esta ciudad.';
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

            if($puntaje->trivia->id == 4){

                foreach ($preguntas[$numbers[$i] - 1]->respuestas as $respuesta){

                    $intento = new Intento([
                        'query_ord' => $id_preg,
                        'pregunta_id' => $preguntas[$numbers[$i] - 1]->id,
                        'puntaje_id' => $puntaje->id,
                    ]);

                    $t++;
                    $id_res = str_random(9);
                    $resp[$t] = array('id' => $id_res);
                    if($respuesta->correct == 1){
                        $intento->respuesta_id = $respuesta->id;
                        $intento->correct_str = $respuesta->option;
                    }
                    $intento->save();

                }
            } else {
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

                $intento->save();
            }


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
                $pre_data['pregunta'] = 'data:image/png;base64,'.$base64;
            } else if($puntaje->trivia->id == 2)
            {
                $contents = Storage::get($preguntas[$numbers[$i] - 1]->question);
                $base64 = base64_encode($contents);
                $pre_data['pregunta'] = 'data:image/gif;base64,'.$base64;
                $pre_data['caption'] = $preguntas[$numbers[$i] - 1]->caption;
            } else if($puntaje->trivia->id == 4){

                $contents = Storage::get($preguntas[$numbers[$i] - 1]->question);
                $base64 = base64_encode($contents);
                $pre_data['pregunta'] = 'data:image/png;base64,'.$base64;
            }

            $data = array_add( $data, $i, $pre_data);

        }

        $vartimenow = Carbon::now('America/Mexico_City');
        $puntaje->time_start = $vartimenow;
        $puntaje->save();

        return array(
            'code' => 200,
            'status' => 'success',
            'data' => array(
                'servertime' => $vartimenow->timestamp*1000,
                'endtime' => $vartimenow->addSeconds($puntaje->trivia->time_limit)->timestamp*1000,
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

                if($puntaje->trivia->id == 4) {
                    $intento->attempt_str = $dat['x'].','.$dat['y'];
                    $arr = explode(',', $intento->correct_str);
                    if(abs($arr[0]-$dat['x'])< 30 && 30 > abs($dat['y'] - $arr[1])){
                        $puntos++;
                    }
                    $intento->save();

                } else {

                    if($intento->query_ord == $dat['id']){
                        $intento->attempt_str = $dat['option'];
                        if($intento->correct_str == $dat['option']){
                            $puntos++;
                        }
                        $intento->save();
                    }
                }

            }
        }

        $puntaje->query_score = $puntos * $valor_pregunta;
        $puntaje->punish_factor = floor($puntos * $valor_pregunta * $porfac);
        $puntaje->total_score = $puntaje->query_score + $puntaje->punish_factor;

        $participa->points = floor($participa->points + $puntaje->total_score);
        $participa->save();
        $puntaje->save();


        $puntajeStatus = Puntaje::where('available', 1)
            ->where('participante_id', $participa->id)->where('ciudad_id', $puntaje->ciudad_id)->get();

        /* Todo: desHardcodear el numero de ciudades restantes */

        if($puntajeStatus->isEmpty() && $puntaje->ciudad_id < 5){

            $mensaje = '¡Felicidades! Has logrado terminar esta ruta, ';

            $ciudad = Ciudad::find($puntaje->ciudad_id + 1 );

            if($ciudad->is_publish == 1){
                $mensaje .= 'Avanza a la siguiente ruta.';
            } else {
                $mensaje .= 'La siguiente ciudad estará disponible en ';
                $mensaje .= $this->messageNextCity(new Carbon($ciudad->publish));
            }

        } elseif( $puntajeStatus->isEmpty() && $puntaje->ciudad_id == 5){
            $mensaje = "¡Felicidades! Inglaterra es la ruta que elegimos para que hagas el viaje de tus sueños.";

        } else {
            $mensaje = 'No te desesperes, el siguiente juego estará disponible en 15 minutos.';
        }

        return array(
            'code' => 200,
            'status' => 'success',
            'data' => array(
                'message' => $mensaje,
                'score_dynamic' => $puntaje->query_score,
                'score_time' => $puntaje->punish_factor,
                'score_new' => $participa->points
            ));

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

            if($trivia_id == 4){

                foreach ($intento->pregunta->respuestas as $respuesta){

                    $r++;
                    $id_res = str_random(9);
                    $resp[$r] = array('id' => $id_res);
                    if($respuesta->correct == 1){
                        $intento->correct_str = $respuesta->option;
                    }
                    $intento->save();

                }

            } else {

                foreach ($intento->pregunta->respuestas as $respuesta) {

                    $r++;
                    $id_res = str_random(9);
                    $resp[$r] = array('id' => $id_res, 'option' => $respuesta->option);
                    if($respuesta->correct == 1){
                        $intento->correct_str = $id_res;
                    }
                }

                $intento->save();
            }


            $pre_data = [
                'id' => $intento->query_ord,
                'pregunta' => $intento->pregunta->question,
                'respuestas' => $resp
            ];

            if($trivia_id == 1)
            {
                $contents = Storage::get($intento->pregunta->question);
                //$imagedata = file_get_contents($file);
                $base64 = base64_encode($contents);
                $pre_data['pregunta'] = 'data:image/png;base64,'.$base64;
            } else if($trivia_id == 2)
            {
                $contents = Storage::get($intento->pregunta->question);
                $base64 = base64_encode($contents);
                $pre_data['pregunta'] = 'data:image/gif;base64,'.$base64;
                $pre_data['caption'] = $intento->pregunta->caption;
            } else if($trivia_id == 4){

                $contents = Storage::get($intento->pregunta->question);
                $base64 = base64_encode($contents);
                $pre_data['pregunta'] = 'data:image/png;base64,'.$base64;
            }

            $data = array_add( $data, $t, $pre_data);

        }
        return $data;
    }

    public function messageNextCity($fecha_publica)
    {
        $ahora = Carbon::now('America/Mexico_City');

        $message = '';
        $dias = $ahora->diffInDays($fecha_publica);
        $sindias = $fecha_publica->subDays($dias);
        $horas = $ahora->diffInHours($sindias);
        $sinhoras  = $sindias->subHours($horas);
        $minutos = $ahora->diffInMinutes($sinhoras);

        /* todo: Mensaje más amigable */

        $message .= ($dias > 0) ? $dias.($dias == 1 ? ' día, ' :' días, ') : '';
        $message .= ($horas > 0) ? $horas.' hora'. ( $horas === 1 ? '':'s') .', ' : '';
        $message .= ($minutos > 0) ? $minutos.' minuto'.( $minutos == 1 ? '': 's') : '';
        return $message.'.';
    }

}