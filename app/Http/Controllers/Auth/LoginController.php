<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\ActiveCode\ActiveCodeService;
use App\Services\SMS\SMS;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    protected function authenticated(Request $request, $user)
    {
        if ($user->two_fa) {
            $phone = "+" . $user->country_code . $user->phone;
            SMS::sendPattern($phone);
            Auth::logout();
            return redirect()->route('show.two.factor.form', $user);
        }else {
            return redirect()->intended($this->redirectPath());
        }
    }

    public function showTwoFactorForm($user)
    {
        return view('auth.two-fa', compact('user'));
    }

    public function authenticateTwoFactor(Request $request, ActiveCodeService $activeCodeService, $userId)
    {
        $user = User::getUser($userId);

        if (!$activeCodeService->checkExpirationIsValid($user)) {
            return redirect()->back()->withErrors('Code you entered is expired, login again to send new code...!');
        } elseif (!$activeCodeService->checkCodeIsTrue($request->input('code'), $user)) {
            return redirect()->back()->withErrors('Code you entered is incorrect...!');
        } else {
            $activeCodeService->deleteCode($user);
            Auth::login($user);

            return redirect()->route('home');
        }
    }
}
