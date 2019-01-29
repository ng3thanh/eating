<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SessionController extends Controller
{
    /**
     * SessionController constructor.
     */
    public function __construct()
    {
    }

    /**
     * Show the Login Form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin()
    {
        return view('auth.auth.login');
    }

    /**
     * Handle a Login Request
     *
     * @param Request $request
     * @return mixed
     */
    public function postLogin(Request $request)
    {

        // Validate the Form Data
        $this->validate($request, ['username' => 'required', 'password' => 'required']);

        // Assemble Login Credentials
        $credentials = ['username' => trim($request->get('username')), 'password' => $request->get('password'),];
        $remember = (bool)$request->get('remember', false);

        // Attempt the Login
        $login = auth()->attempt($credentials, $remember);

        if ($login) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Handle a Logout Request
     *
     * @param Request $request
     * @return mixed
     */
    public function getLogout(Request $request)
    {
        // Terminate the user's current session.  Passing true as the
        // second parameter kills all of the user's active sessions.
        $auth = auth()->logout();
        if ($auth) {
            return redirect()->route('auth.login.form');
        } else {
            return redirect()->back();
        }
    }
}
