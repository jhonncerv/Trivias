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

        $puntajeStatus = Puntaje::with('trivia')
            ->where('available', 0)
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

        $ciudad = Ciudad::where('name', $request->city)->first();
        if ($ciudad->is_publish == 1) {

            return $this->triviaConnect->giveMeTrivia($ciudad->id);

        }

        $fecha_publica = new Carbon($ciudad->publish, 'America/Mexico_City');
        $message = 'Esta ciudad estará disponible en ';
        $response['message'] = $message.$this->triviaConnect->messageNextCity($fecha_publica);

        return $response;
    }

    public function startGame()
    {

        $puntaje = Puntaje::with('intentos.pregunta.respuestas', 'trivia.preguntas.respuestas')
                            ->where('available', 0)
                            ->where('participante_id', Auth::user()->participante[0]->id)
                            ->where('time_finish', null)->first();

        if(empty($puntaje)){
            return array(
                'code' => 401,
                'status' => 'error',
                'message' => 'Aún no has iniciado ninguna trivia.');
        }
        if($puntaje->time_start !== null){

            return array(
                'code' => 200,
                'status' => 'success',
                'data' => array(
                    'preguntas' => $this->triviaConnect->continuMeTrivia($puntaje->intentos, $puntaje->trivia->id)
                ));
        }

        return $this->triviaConnect->startMeTrivia($puntaje);

    }

    public function stopGame(Request $request)
    {
        if(empty($request->data)){
            return array(
                'code' => 401,
                'status' => 'error',
                'message' => 'Aún no has terminado la dinámica.');

        }
        $participa = Auth::user()->participante[0];
        $puntaje = Puntaje::with('intentos', 'trivia')
                ->where('available', 0)
                ->where('participante_id', $participa->id)
                ->where('time_finish', null)
                ->where('time_start', '<>', null)
                ->first();

        if(empty($puntaje)){
            return array(
                'code' => 401,
                'status' => 'error',
                'message' => 'Aun no has iniciado ninguna trivia.');
        }

        return $this->triviaConnect->stopMeTrivia($participa, $puntaje, $request->data);


    }

}
