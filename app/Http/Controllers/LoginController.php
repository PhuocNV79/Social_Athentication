<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class LoginController extends Controller
{
    protected $provider = 'twitter';

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function loginWithTwitter()
    {
        return 'loginWithTwitter';
    }

    public function redirectToTwitter()
    {
        return Socialite::driver($this->provider)->redirect();
    }

    public function handleTwitterCallback()
    {
        $user = Socialite::driver($this->provider)->user();
        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser() //$user
    {
//        $user = User::create([
//            'name'     => 'nguyenvanphuoc',
//            'email'    => 'nguyenvanphuoc4@gmail.com',
//            'provider' => $this->provider,
//            'provider_id' => 3223
//        ]);

        $user = new User();

        $user->name = 'nguyenvanphuoc';
        $user->email = 'nguyenvanphuoc@email.com';
        $user->provider = $this->provider;
        $user->provider_id = 24352345;


        $authUser = User::where('provider_id', 3224)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $this->provider,
            'provider_id' => $user->provider_id
        ]);
    }
}
