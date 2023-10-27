<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();
    }

    public function authUser(Request $request)
    {
        $user = new User();

        $user->email = $request->email;

        $user->password = $request->password;

        $auth = Auth::attempt(['email' => $user->email, 'password' => $user->password]);

        if ($auth) {
            Auth::login($user, $remember = true);
        }

        return $auth;
    }
}
