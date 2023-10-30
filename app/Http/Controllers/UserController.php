<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function createUser()
    {
        validator(request()->all(), [
            'signupusername' => 'required|unique:users,name',
            'signupemail' => 'required|email|unique:users,email',
            'signuppassword' => 'required|min:8|confirmed'
        ])->validate();




        $user = new User();

        $user->name = request()->signupusername;
        $user->email = request()->signupemail;
        $user->password = bcrypt(request()->signuppassword);

        $user->save();
        auth()->login($user);
        return redirect('/');
    }

    public function authUser()
    {
        validator(request()->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ])->validate();

        $remember = true;

        if (auth()->attempt(request()->only(['email', 'password'], $remember))) {
            session(['user' => auth()->user()]);
            return redirect("/");
        }

        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        session()->forget('user');
        auth()->logout();

        return redirect('/');
    }

    public function getUsername()
    {
        $id = request()->userId;

        $user = User::find($id);

        return $user->name;
    }
}
