<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiAuthController extends Controller {

    public function __construct() {
        $this->middleware('jwt.auth', ['except' => ['userAuth']]);
    }

    public function userAuth(Request $request) {
        $credentials = $request->only('correo', 'password');
        $token = null;
        $user = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                $user = \Response::json(['error' => 'invalid_credentials']);
            }
        } catch (JWTException $e) {
            $user = \Response::json(['error' => 'somthing_went_wrong'], 500);
        }
        $users = User::where('correo', '=', $request->correo, 'AND', 'password', '=', $request->password)->first();
      if (isset($users) {
        $user = \Response::json(['user' => $users, 'token' => $token], 200);
      }
        return $user;
    }
}
