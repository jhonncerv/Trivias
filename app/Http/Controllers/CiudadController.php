<?php

namespace App\Http\Controllers;

use App\Ciudad;
use App\Participante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CiudadController extends Controller
{

    public function index()
    {
        //Session::flush();
        $participante = array();
        $ciudades = array();

        if ( Auth::check() ){
            $participante = Participante::find(Auth::user()->participante);
            $ciudades = Ciudad::where('available', 1)->get();
        }
        return view('welcome')->with(compact('participante', 'ciudades'));
    }

    public function ciudades()
    {
        $ciudad = Ciudad::all();
        return $ciudad;
    }

    public function tyco()
    {
        return view('tyco');
    }

    public function mecanica()
    {
        return view('mecanica');
    }

}
