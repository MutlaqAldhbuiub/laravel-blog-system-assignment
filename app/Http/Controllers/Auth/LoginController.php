<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use Socialite;
use Laravel\Socialite\Facades\Socialite;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }






    // custom functions to support socialite
    public function redirectToProvider(string $provider)
    {
        try {
            $scopes = config("services.$provider.scopes") ?? [];
            if (count($scopes) === 0) {
                return Socialite::driver($provider)->redirect();
            } else {
                return Socialite::driver($provider)->scopes($scopes)->redirect();
            }
        } catch (\Exception $e) {
            abort(404);
        }
    }


    public function handleProviderCallback(string $provider)
    {
        try {
            $data = Socialite::driver($provider)->user();

            return $this->handleSocialUser($provider, $data);
        } catch (\Exception $e) {
            return redirect('login')->withErrors(['authentication_deny' => 'Login with '.ucfirst($provider).' failed. Please try again.']);
        }
    }


    public function handleSocialUser(string $provider, object $data)
    {
        $user = User::where([
            "social->{$provider}->id" => $data->id,
        ])->first();
        if (!$user) {
                    $user = User::where([
                        'email' => $data->email,
                    ])->first();
                }
        if (!$user) {
            return $this->createUserWithSocialData($provider, $data);
        }
        $social = $user->social;
            $social[$provider] = [
                'id' => $data->id,
                'token' => $data->token
            ];
            $user->social = $social;
            $user->save();
    return $this->socialLogin($user);
    }



    public function createUserWithSocialData(string $provider, object $data)
    {
        try {
            $user = new User;
            $user->name = $data->name;
            $user->email = $data->email;
            $user->national_id = '0';
            $user->social = [
                $provider => [
                    'id' => $data->id,
                    'token' => $data->token,
                ],
            ];
            // Check support verify or not
            if ($user instanceof MustVerifyEmail) {
                $user->markEmailAsVerified();
            }
            $user->save();
            return $this->socialLogin($user);
        } catch (Exception $e) {
            return redirect('login')->withErrors(['authentication_deny' => 'Login with '.ucfirst($provider).' failed. Please try again.']);
        }
    }



    public function socialLogin(User $user)
    {
        auth()->loginUsingId($user->id);
        return redirect($this->redirectTo);
    }

}
