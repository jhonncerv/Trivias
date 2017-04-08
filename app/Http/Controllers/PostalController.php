<?php

namespace App\Http\Controllers;

use App\Postal;
use Illuminate\Http\Request;

class PostalController extends Controller
{
    public function index()
    {
        $postales = Postal::all();
        return $postales;
    }

    public function postal()
    {
        
    }
}
