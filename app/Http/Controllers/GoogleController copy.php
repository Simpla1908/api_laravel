<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;


class GoogleController extends Controller
{
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider){
        $getinfo=Socialite::drive($provider)->user();
        $user=$this->createUser($getinfo,$provider);
        auth()->login($user);
        return redirect('http://localhost:3000/login/google'.$user->api_token);
    }
    public function createUser($getinfo,$provider){
        $user=User::where('provider_id',$getinfo->id)->first();
        if(!$user){
            $user=User::create([
                'email' => $getinfo->email,
                'name' => $getinfo->name,
                'provider' => $provider,
                'provider_id' =>$getinfo->id,
                'api_token' =>Str::random(60)
            ]);
        }
        return $user;
        
    }
}