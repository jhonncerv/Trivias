<?php

namespace App\Http\Controllers;

use App\Postal;
use Illuminate\Http\Request;

class PostalController extends Controller
{
    public function index()
    {
        $postales = Postal::all();
        return view('postales', compact('postales'));
    }

    public function postal()
    {

    }
}
