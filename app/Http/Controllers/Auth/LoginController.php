<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;
use Validator;

class LoginController extends Controller {
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

    public function username() {
        return 'mobile_no';
    }

    public function showLoginForm() {
        return view('login');
    }

    protected function credentials(Request $request) {
        $data = $request->only($this->username(), 'password');
        $data['type'] = 'system';
        return $data;
    }

    public function apiLogin(Request $request) {
        $validator = Validator::make($request->all(), [
                    'mobile_no' => 'required|string',
                    'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return appApiResponse(422, "The given data was invalid.", $validator->errors(), $data = null);
        }
        try {

            $credentials = request(['mobile_no', 'password']);
            $credentials['type'] = 'visitor';
            if (!Auth::attempt($credentials))
                return appApiResponse(401,trans('auth.failed'),null);
            $user = $request->user();
            $token = Str::random(60) . $user->mobile_no;
            $user->api_token = $token;
            $user->save();
            return appApiResponse(200, 'Login successful',null,['user' => $user]);
        } catch (\Exception $e) {
            \Log::error($e);
            return appApiResponse(500,__('app.something_went_wrong'),__('app.something_went_wrong'),null);
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

}
