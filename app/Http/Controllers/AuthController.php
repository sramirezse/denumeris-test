<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\RecoveryPassMail;
use Illuminate\Support\Env;

// use App\Controllers\Controller;
class AuthController extends Controller
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

    public function index(Request $request)
    {
        $users = User::where('role->name', 'admin')->get();
        return response()->json($users);
    }


    public function loginAdmin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::user()) {
            return response()->json(['user' => Auth::user()]);
        }
        if (Auth::attempt($credentials)) {
            $user = User::where('role->name', 'admin')->where('email', $request->email)->first();
            $user->token = $user->createToken('auth');

            return response()->json(["user" => $user, 'success' => true, 200]);
        }
        return response()->json(['error' => 'Unauthorized', 'success' => false, $request->all()], 401);
    }
    public function user()
    {
        if (Auth::user()) {
            $user = [];
            $user['id'] = Auth::user()->id;
            $user['name'] = Auth::user()->name;
            $user['email'] = Auth::user()->email;
            $user['avatar'] = 'https://ui-avatars.com/api/background=6C5FFC&color=fff?name=' .   Str::snake(Auth::user()->name);

            return response()->json(['success' => true, 'status' => 200, 'user' => $user]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['success' => true, $request->all()]);
    }

}
