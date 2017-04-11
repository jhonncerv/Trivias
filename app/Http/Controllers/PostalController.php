<?php

namespace App\Http\Controllers;

use App\Postal;
use App\Share;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostalController extends Controller
{
    public function index()
    {
        $postales = Postal::with('ciudad')->get()->reject(function ($postal) {
            return $postal->ciudad->is_publish == 0;
        });
        return view('postales', compact('postales'));
    }

    public function postea(Request $request)
    {
        if(Auth::guest()){
            return array(
                'code' => 401,
                'status' => 'error',
                'message' => 'Regístrate <a href="/">aquí</a> y comienza a acumular puntos.'
            );
        }

        if(!$request->has('data')){
            return array(
                'code' => 401,
                'status' => 'error',
                'message' => 'Hacker es malo :('
            );
        }

        $participante = Auth::user()->participante[0];

        $postal = Postal::findOrFail($request->data['postal_id']);
        $share_exist = Share::where('postal_id', $postal->id)
            ->where('participante_id', $participante->id)->get();

        if($share_exist->isNotEmpty()){

            return array(
                'code' => 401,
                'status' => 'error',
                'message' => 'Ya has compartido esta ciudad.'
            );
        }

        Share::Create([
            'fb_post_id'=> 'facebook',
            'postal_id' => $postal->id,
            'participante_id' => $participante->id,
            'points' => $postal->points
        ]);
        $participante->points = $participante->points + $postal->points;
        $participante->save();

        return array(
            'code' => 200,
            'status' => 'success',
            'data' => array(
                'postal_points' => $postal->points,
                'points_new' => $participante->points
            )
        );
    }

    public function postal($id)
    {
        $postal = Postal::where('name', $id)->get();
        if($postal->isEmpty()){
            return redirect()->route('home');
        }
        return view('postal', compact('postal'));
    }
}
