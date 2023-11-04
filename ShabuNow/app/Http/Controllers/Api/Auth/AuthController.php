<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request){

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        return $this->makeToken($user);
    }
    public function register(RegisterRequest $request){
           $user = User::create($request->validated());
           return $this->makeToken($user);

    }
    public function makeToken($user){
        $token =  $user->createToken('myToken')->plainTextToken;
        return AuthResource::make([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'role' => $user->role,
                'created_at' => $user->created_at,
            ]
            ]);
    }
    // change password
//    public function updatePassword(Request $request, User $user) {
//        $request->validate([
//            'old_password' => ['required','min:5'],
//            'new_password' => ['required','min:5','confirmed']
//        ]);
//        $user->password = Hash::make($request->get('password'));
//
//        if (!Hash::check($request->get('old_password'), $user->password)) {
//            return response()->json([
//                "error" => "Incorrect old password!",
//                "old_password" => $request->get('old_password'),
//                "hashed password" => $user->password,
//                ]);
//        }
//
//        $user->password = Hash::make($request->get('new_password'));
//        $user->save();
//        $user->refresh();
//
//        return response()->json(["status" => "Change password successfully!"]);
//    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'logout success'],200);
    }
}
