<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectToProvider($social)
    {
        return Socialite::driver($social)->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return \Illuminate\Http\Response
     */

    private function findOrCreateUser($social)
    {
        $authUser = User::where('provider_id', $social->id)->first();

        if ($authUser) {
            return $authUser;
        }

        if ($social->email) {
            $authUser = User::where('email', $social->email)->first();

            if ($authUser) {
                if ($authUser->provider_id != $social->id) {
                    $authUser->update(['provider_id' => $social->id, 'provider' => $social->provider]);
                }
                return $authUser;
            }
        }

        if (empty($social->email)) {
            $social->email = sprintf('%s@gmail.com', $social->id);
        }

        return User::create([
            'username' => $social->name,
            'password' => $social->id,
            'email' => $social->email,
            'level' => '0',
            'provider_id' => $social->id,
            'provider' => $social->provider,
        ]);
    }

    public function handleProviderCallback($social)
    {
        $user = Socialite::driver($social)->user();
        $user->provider = $social;
        $authUser = $this->findOrCreateUser($user);
        $authUser->assignRole('member');
        Auth::login($authUser, true);
        return redirect()->route('users.profile', $authUser->id);
    }
}
