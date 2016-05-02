<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends AuthController
{
    protected $redirectAfterLogout = '/admin/login';
    protected $redirectTo = '/admin';
    protected $loginPath = '/admin/login';

    /**
     * Login form.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        return view('admin.login');
    }

    /**
     * Logout.
     *
     * @return Response
     */
    public function getLogout()
    {
        Auth::logout();

        return redirect($this->redirectAfterLogout);
    }

    /**
     * Post login.
     *
     * @return bool
     */
    public function postLogin(Request $request)
    {
        if ( Auth::attempt([
                'email' => $request->email,
                'password' => $request->password, ]
        )) {
            // Not admin
            if ( Auth::user()->isCustomer() ) {
                $this->redirectTo = '/';
            }            
            return redirect($this->redirectTo);            
        }

        return redirect($this->loginPath)
            ->withInput($request->only('login', 'remember'))
            ->withErrors([
                'login' => 'These credentials do not match our records.',
            ]);
    }
}
