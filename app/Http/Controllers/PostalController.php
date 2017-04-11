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
        $postales = Postal::all();
        return view('postales', compact('postales'));
    }

    public function postea(Request $request)
    {
        if(Auth::guest() || ($request->post_id !== 'twitter' && $request->post_id !== 'facebook') || !$request->has('postal_id')){
            return array(
                'code' => 401,
                'status' => 'error',
                'message' => 'Regístrate <a href="/">aquí</a> y comienza a acumular puntos.'
            );
        }

        $participante = Auth::user()->participante[0];
        $shares = $participante->shares;
        foreach ($shares as $share){
            if($share->postal_id == $request->post_id){
                return array(
                    'code' => 401,
                    'status' => 'error',
                    'message' => 'Ya haz posteado esta postal.'
                );
            }
        }


        $postal = Postal::findOrFail($request->postal_id);

        Share::firstOrCreate([
            'fb_post_id'=> $request->post_id,
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
