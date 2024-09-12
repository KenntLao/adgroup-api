<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Email is not registered.',
                'code' => Response::HTTP_UNAUTHORIZED
            ], 401);
        }

        if ($request->has('password') && !Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'message' => 'Invalid Credentials.',
                'code' => Response::HTTP_UNAUTHORIZED
            ], 401);
        }

        $newAccessToken = $user->createToken($request->header('user-agent'));

        return response()->json([
            'token' => $newAccessToken->plainTextToken,
            'user' => UserResource::make($user)
        ]);
    }
}
