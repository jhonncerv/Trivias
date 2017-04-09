<?php

namespace App\Http\Controllers;

use App\Participante;
use App\User;
use Illuminate\Support\Facades\Auth;
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
     * @return array
     */
    public function handleProviderCallback(Request $request)
    {
        if($request->input('code')) {

            $user = Socialite::driver('facebook')->user();

            $usuario = User::firstOrCreate([
                'email' => $user->getEmail(),
            ]);

            $participante = Participante::firstOrNew([
                'email' => $user->getEmail(),
                'user_id' => $usuario->id
            ]);

            $participante->name = $user->getName();
            $participante->facebook_id = $user->id;
            $participante->nickname = $user->getNickname();
            $participante->photo = $user->getAvatar();
            $participante->token_oauth = $user->token;
            $participante->save();

            Auth::login($usuario, true);

            $responce = array(
                'code' => 200,
                'status' => 'success',
                'data' => array(
                    'logued' => Auth::check(),
                    'guest' => Auth::guest(),
                    'facebook_id' => $participante->facebook_id,
                    'facebook_token' => $participante->token_oauth,
                ));

            return $responce;
        }

        return Socialite::driver('facebook')->redirect();
    }

    public function login(Request $request){

        if (Auth::check() || $request->token == '') {
            return redirect()->route('home');
        }

        $token = $request->token;
        $user = Socialite::driver('facebook')->userFromToken($token);

        $responce = array(
            'code' => 200,
            'status' => 'success',
            'data' => array(
                'facebook_id' => $user->id,
                'name' => $user->name,
                'photo' => $user->avatar
            ));

        return $responce;

    }

}
