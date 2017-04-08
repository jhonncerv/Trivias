<?php

namespace App\Http\Controllers;

use App\Respuesta;
use Illuminate\Http\Request;

class RespuestaController extends Controller
{

    public function index()
    {
        $respuesta = Respuesta::all();
        return $respuesta;
    }
}
