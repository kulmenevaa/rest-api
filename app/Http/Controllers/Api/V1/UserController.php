<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class UserController extends Controller
{
    public function register(RegisterRequest $request) {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $token = $user->createToken('api-application')->accessToken;
        return response()->json([
            'message'   => 'Вы успешно зарегистрированы!',
            'token'     => $token
        ], 200); 
    }

    public function login(LoginRequest $request) {
        $userByEmail = User::where('email', $request->email)->first();
        if(!$userByEmail || !Hash::check($request->password, $userByEmail->password)) {
            return response()->json([
                'message'   => 'Пользователь не найден!'
            ], 401);
        }
        
        $credentials = [
            'email'     => $request->email,
            'password'  => $request->password
        ];
        if(Auth::attempt($credentials)) {
            $token = $request->user()->createToken('api-application')->accessToken;
            return response()->json([
                'message'   => 'Вы успешно авторизованы!',
                'token'     => $token
            ], 200);
        }
    }

    public function logout(Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        return response()->json([
            'message' => 'Вы успешно вышли из системы!'
        ], 200);
    }
}
