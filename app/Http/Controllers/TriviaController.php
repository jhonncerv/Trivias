<?php

namespace App\Http\Controllers;

use App\Ciudad;
use App\Intento;
use App\Puntaje;
use App\Trivia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TriviaConect;

class TriviaController extends Controller
{

    private $triviaConect;
    /**
     * TriviaController constructor.
     */
    function __construct(TriviaConect $triviaConect)
    {
        $this->triviaConect = $triviaConect;
    }

    public function index()
    {
        $trivia = Trivia::all();
        return $trivia;
    }

    public function todayGame($id)
    {
        $now = Carbon::now('America/Mexico_City');
        $ciudad = Ciudad::find($id);
        $puntajeStatus = Puntaje::where('available', 0)->where('time_finish', null)->where('participante_id', Auth::user()->participante[0]->id)->get();

        $response = array(
            'code' => 401,
            'status' => 'expirated'
        );

        if($puntajeStatus->isNotEmpty()){
            $response['data']['message'] = 'Termina tu otra trivia antes de pedir otro juego.';
            return $response;
        }

        if ($now->diffInDays(new Carbon($ciudad->publish,'America/Mexico_City')) <= 2) {

            return $this->triviaConect->giveMeTrivia($id);

        }

        $response['data']['message'] = 'No te desesperes pronto revelaremos la ciudad, por lo pronto sigue jugando las anteriores rutas. ';
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

        return $this->triviaConect->startMeTrivia($puntaje[0]);

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

        return $this->triviaConect->stopMeTrivia($participa, $puntaje[0], $request->data);


    }

}
