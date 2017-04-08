<?php

namespace App\Http\Controllers;

use App\Participante;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }


    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        // $user->token;
        dd($user);
        return $user->token;
    }

    public function login(Request $request){
        $token = $request->token;
        $user = Socialite::driver('facebook')->userFromToken($token);
        $participante = Participante::firstOrNew([
            'email' => $user->getEmail()
        ]);
        $participante->name = $user->getName();
        $participante->facebook_id = $user->id;
        $participante->nickname = $user->getNickname();
        $participante->photo = $user->getAvatar();
        $participante->token_oauth = $user->token;
        $participante->save();

        $responce = array([
            'code' => 200,
            'status' => 'success',
            'data' => array([
                'facebook_id' => $participante->facebook_id,
                'name' => $participante->name,
                'photo' => $participante->photo
            ])
        ]);

        return $responce;

    }

}
