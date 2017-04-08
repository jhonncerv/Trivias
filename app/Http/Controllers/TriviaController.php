<?php

namespace App\Http\Controllers;

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

    public function startGame($id)
    {

    }

    public function stopGame($id)
    {

    }
}
