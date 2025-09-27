<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(UserStoreRequest $request)
    {
        try {
            $user = User::create($request->validated());

            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'message' => 'کاربر با موفقیت اضافه شد',
                'token'   => $token
            ], 200);
        } catch (\Exception $e) {
            return [
                'message' => 'کاربر با موفقیت اضافه نشد',
                'errors'  => $e->getMessage()
            ];
        }
    }

    public function login(AuthLoginRequest $request)
    {
        try {
            $user = User::whereEmail($request->email)->first();

            if (Hash::check($request->password, $user->password)) {
                return response()->json([
                    'token' => $user->createToken('auth-token')->plainTextToken
                ]); 
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'عملیات ورود کاربر با مشگل مواجه شده است',
                'errors'  => $e->getMessage()
            ]);
        }
    }

    public function logout()
    {
        try {
            if (auth('api')->check()) {
                /** @var User $user */
                $user = auth('api')->user();

                $user->tokens()->delete();

                return response()->json([
                    'message' => 'کاربر با موفقیت خارج شد'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'در خارج کردن کاربر مشگلی پیش آمده', 'errors' => $e->getMessage()], 422);
        }
    }

    public function user(): User
    {
        return auth('api')->user();
    }
}
