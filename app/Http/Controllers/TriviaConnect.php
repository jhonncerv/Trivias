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

    /**
     * @param $id
     * @return array
     */
    public function giveMeTrivia($id)
    {

        $response = array(
            'code' => 401,
            'status' => 'error'
        );

        $participa= Auth::user()->participante[0];

        $puntaje = $participa->puntajes()->where('ciudad_id', $id)->get();

        if($puntaje->isEmpty()){

            $trivias = Trivia::where('available', 1)->get();

            $trivias = $trivias->filter(function ($value) use ($id) {
                for ($i = (1 + (4 * ($id - 1))); $i <= (4 + (4 * ($id - 1)));$i++){
                    if($value->id == $i){
                        return true;
                    }
                }
                return false;
            });


            foreach ($trivias as $trivia){
                $points_pushed = Puntaje::Create([
                    'trivia_id' => $trivia->id,
                    'ciudad_id' => $id,
                    'participante_id' => $participa->id
                ]);
                $puntaje->push($points_pushed);
            }
        }


        $sig_juego = $puntaje->reject(function ($value) {
            return isset($value->available) ? ($value->available == 0) : false  ;
        });


        if($sig_juego->isNotEmpty()){
           foreach($puntaje as $p){

                if($p->time_finish !== null){
                    $diff = new Carbon($p->time_finish, 'America/Mexico_City');
                    $tim = $diff->diffInMinutes(Carbon::now('America/Mexico_City'));

                    if( $tim < 2){
                        $response['message'] = 'No te desesperes, el siguiente juego estará disponible en ';
                        if($tim == 1) {
                            $response['message'].= ' menos de un minuto.';
                        } else {
                            $response['message'].= (2 -$tim) . ' minuto'.($tim == 1 ? '':'s').'.';
                        }
                        return $response;
                    }
                }

            }

            $puntaje = $sig_juego->random();
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

            $pre_data['id'] = $id_preg;

            if($puntaje->trivia->id == 4 || $puntaje->trivia->id == 8 || $puntaje->trivia->id == 12 || $puntaje->trivia->id == 16){

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

                $contents = Storage::get($preguntas[$numbers[$i] - 1]->question);
                $base64 = base64_encode($contents);
                $pre_data['pregunta'] = 'data:image/png;base64,'.$base64;

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

            $pre_data['respuestas'] = $resp;

            if($puntaje->trivia->id == 1 || $puntaje->trivia->id == 5 || $puntaje->trivia->id == 9 || $puntaje->trivia->id == 13)
            {
                $contents = Storage::get($preguntas[$numbers[$i] - 1]->question);
                $base64 = base64_encode($contents);
                $pre_data['pregunta'] = 'data:image/png;base64,'.$base64;

            } else if($puntaje->trivia->id == 2 || $puntaje->trivia->id == 6 || $puntaje->trivia->id == 10 || $puntaje->trivia->id == 14)
            {
                $contents = Storage::get($preguntas[$numbers[$i] - 1]->question);
                $base64 = base64_encode($contents);
                $pre_data['pregunta'] = 'data:image/gif;base64,'.$base64;
                $pre_data['caption'] = $preguntas[$numbers[$i] - 1]->caption;

            } else if($puntaje->trivia->id == 3 || $puntaje->trivia->id == 7 || $puntaje->trivia->id == 11 || $puntaje->trivia->id == 15){
                $pre_data['pregunta'] = $preguntas[$numbers[$i] - 1]->question;
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

    /**
     * @param $participa
     * @param $puntaje
     * @param $data
     * @return array
     */
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

        if($puntaje->trivia->id == 4 || $puntaje->trivia->id == 8 || $puntaje->trivia->id == 12 || $puntaje->trivia->id == 16) {

            for($i = 0; $i < min(count($data),count($intentos)); $i++){
                $intentos[$i]->attempt_str = $data[$i]['x'].','.$data[$i]['y'];
                $intentos[$i]->save();
            }

            foreach ($intentos as $intento) {

                foreach ($data as $k => $dat){
                    $arr = explode(',', $intento->correct_str);
                    if(abs($arr[0]-$dat['x'])< 30 && 30 > abs($dat['y'] - $arr[1])){
                        unset($data[$k]);
                        $puntos++;
                        break;
                    }
                }

            }

        } else {

            foreach ($intentos as $intento) {
                foreach ($data as $dat) {
                    if ($intento->query_ord == $dat['id']) {
                        $intento->attempt_str = $dat['option'];
                        if ($intento->correct_str == $dat['option']) {
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

    /**
     * @param $intentos
     * @param $trivia_id
     * @return array
     */
    public function continuMeTrivia($intentos, $trivia_id)
    {
        $data = [];
        $t = -1;
        foreach ($intentos as $intento){
            $t++;

            $intento->query_ord = str_random(9);

            $resp = [];
            $r = -1;

            $pre_data['id'] = $intento->query_ord;

            if($trivia_id == 4 || $trivia_id == 8 || $trivia_id == 12 || $trivia_id == 16){

                foreach ($intento->pregunta->respuestas as $respuesta){

                    $r++;
                    $id_res = str_random(9);
                    $resp[$r] = array('id' => $id_res);
                    if($respuesta->correct == 1){
                        $intento->correct_str = $respuesta->option;
                    }
                    $intento->save();
                }
                $contents = Storage::get($intento->pregunta->question);
                $base64 = base64_encode($contents);
                $pre_data['pregunta'] = 'data:image/png;base64,'.$base64;


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

            $pre_data['respuestas'] = $resp;

            if($trivia_id == 1 || $trivia_id == 5 || $trivia_id == 9 || $trivia_id == 13 )
            {
                $contents = Storage::get($intento->pregunta->question);
                $base64 = base64_encode($contents);
                $pre_data['pregunta'] = 'data:image/png;base64,'.$base64;

            } else if($trivia_id == 2 || $trivia_id == 6 || $trivia_id == 10 || $trivia_id == 14 )
            {
                $contents = Storage::get($intento->pregunta->question);
                $base64 = base64_encode($contents);
                $pre_data['pregunta'] = 'data:image/gif;base64,'.$base64;
                $pre_data['caption'] = $intento->pregunta->caption;

            } else if($trivia_id == 3 || $trivia_id == 7 || $trivia_id == 11 || $trivia_id == 15 ){
                $pre_data['pregunta'] = $intento->pregunta->question;
            }

            $data = array_add( $data, $t, $pre_data);

        }
        return $data;
    }

    /**
     * @param $fecha_publica
     * @return string
     */
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
        $message .= ($minutos > 1) ? $minutos.' minutos.' : 'menos de un minuto.';
        return $message;
    }

}