<?php

namespace App\Http\Controllers;

use App\Ciudad;
use App\Intento;
use App\Puntaje;
use App\Trivia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TriviaConnect;

class TriviaController extends Controller
{

    private $triviaConnect;
    /**
     * TriviaController constructor.
     */
    function __construct(TriviaConnect $triviaConnect)
    {
        $this->triviaConnect = $triviaConnect;
    }

    public function index()
    {
        $trivia = Trivia::all();
        return $trivia;
    }

    public function todayGame(Request $request)
    {

        $puntajeStatus = Puntaje::with('trivia')->where('available', 0)
            ->where('time_finish', null)
            ->where('participante_id', Auth::user()->participante[0]->id)->get();

        $response = array(
            'code' => 401,
            'status' => 'error'
        );

       if($puntajeStatus->isNotEmpty()){
            $response = array(
                'code' => 200,
                'status' => 'success',
                'data' => array(
                    'type' => $puntajeStatus[0]->trivia->game
                ));
            return $response;
        }

        $ciudad = Ciudad::where('name', $request->city)->get();
        if ($ciudad[0]->is_publish == 1) {

            return $this->triviaConnect->giveMeTrivia($ciudad[0]->id);

        }

        $fecha_publica = new Carbon($ciudad[0]->publish, 'America/Mexico_City');
        $ahora = Carbon::now('America/Mexico_City');
        $dias = $ahora->diffInDays($fecha_publica);
        $horas = $ahora->diffInHours($fecha_publica);
        $minutos = $ahora->diffInMinutes($fecha_publica);

        /* todo: Mensaje más amigable */

        $message = 'Esta ciudad estará disponible en ';
        $message .= ($dias > 0) ? $dias.($dias == 1 ? ' día, ' :' días, ') : '';
        $message .= ($horas > 0) ? $horas.' hora'. ( $horas === 1 ? '':'s') .', ' : '';
        $message .= ($minutos > 0) ? $minutos.' minuto'.( $minutos == 1 ? '': 's') : '';

        $response['message'] = $message.'.';
        return $response;
    }

    public function startGame()
    {

        $puntaje = Puntaje::with('intentos.pregunta.respuestas', 'trivia.preguntas.respuestas')
                            ->where('available', 0)
                            ->where('participante_id', Auth::user()->participante[0]->id)
                            ->where('time_finish', null)->get();

        if($puntaje->isEmpty()){
            return array(
                'code' => 401,
                'status' => 'error',
                'message' => 'Aun no has iniciado ninguna trivia.');
        }
        if($puntaje[0]->time_start !== null){

            return array(
                'code' => 200,
                'status' => 'success',
                'data' => array(
                    'preguntas' => $this->triviaConnect->continuMeTrivia($puntaje[0]->intentos)
                ));
        }

        return $this->triviaConnect->startMeTrivia($puntaje[0]);

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
                'status' => 'error',
                'message' => 'Aun no has iniciado ninguna trivia.');
        }

        return $this->triviaConnect->stopMeTrivia($participa, $puntaje[0], $request->data);


    }

}
