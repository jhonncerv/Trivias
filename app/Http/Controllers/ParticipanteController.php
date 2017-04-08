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

// EAAYEiELfERcBACCw9FELgkHoLKUUZAT08LuoPY6MFbzhqZAaheIUZCXkc294B3G4jqoLCEFv0Gj8S5E6IZBsHcgLIGGPqQZCdAOdIDsdSnBM7YTj1BoK5ZBAIKXEWLlFvAIniZCxZAOmyx8nFIvZBdR1sxss0G3