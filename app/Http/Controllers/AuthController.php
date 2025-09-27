<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;

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
            return ['message' => 'در خارج کردن کاربر مشگلی پیش آمده', 'errors' => $e->getMessage()];
        }
    }

    public function user(): User
    {
        return auth('api')->user();
    }
}
