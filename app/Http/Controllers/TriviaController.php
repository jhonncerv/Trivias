<?php

namespace App\Http\Controllers;

use App\Ciudad;
use App\Participante;
use App\Trivia;
use Illuminate\Http\Request;

class TriviaController extends Controller
{
    public function index()
    {
        $trivia = Trivia::all();
        return $trivia;
    }

    public function todayGame($id)
    {
        $trivia = Trivia::select('game', 'description')->where('id', $id)->get();
        return $trivia;
    }

    public function startGame(Request $request, $id)
    {
        $ciudad = Ciudad::findOrFail($id);
        $participante = Participante::select(['facebook_id', 'token_oauth'])->where('facebook_id', $request->facebook_id);

        $trivia = Trivia::find(2);


        /* Pasar a trivia */

        $numbers = range(0, 49);
        shuffle($numbers);
        array_slice($numbers, 0, $trivia->query_size);

        $preguntas = [];

        for($i = 0; $i < $trivia->query_size; $i++){
            $preguntas = array_add( $preguntas, $i, [
                'id' => $i + 1,
                'pregunta' => $trivia->preguntas[$numbers[$i]]->question,
                'respuestas' => $trivia->preguntas[$numbers[$i]]->respuestas
            ]);
        }

        /*++++ / Pasar a trivia */

        return array([
            'code' => 200,
            'status' => 'success',
            'data' => array([
                'preguntas' => $preguntas
            ])
        ]);
    }

    public function stopGame($id)
    {
        return array([
            'code' => 200,
            'status' => 'success',
            'data' => array([

            ])
        ]);
    }

}
