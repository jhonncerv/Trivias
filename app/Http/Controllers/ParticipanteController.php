<?php

namespace App\Http\Controllers;

use App\Participante;
use Illuminate\Http\Request;

class ParticipanteController extends Controller
{
    public function index()
    {
        $participantes = Participante::all();
        return $participantes;
    }

    public function mipuntaje()
    {

    }

    public function puntajes()
    {

    }
}