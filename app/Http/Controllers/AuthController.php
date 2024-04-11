<?php

namespace App\Http\Controllers;

use App\Http\Requests\{LoginRequest, RegisterRequest, UpdateProfileRequest};
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\{Auth, Route};

class AuthController extends Controller
{
    public static function routes(): void
    {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('register', [self::class, 'register']);
            Route::post('login', [self::class, 'login']);

            Route::group(['middleware' => 'auth:sanctum'], function () {
                Route::get('profile', [self::class, 'profile']);
                Route::put('profile', [self::class, 'updateProfile']);
            });
        });
    }

    public function register(RegisterRequest $request)
    {
        return success(UserResource::make(User::create($request->validated())), status: 201);
    }

    public function login(LoginRequest $request)
    {
        abort_if(!Auth::attempt($request->validated()), 401);

        $user = Auth::user();

        $user->token = $user->createToken('login')->plainTextToken;

        return success(UserResource::make($user));
    }

    public function profile()
    {
        return success(UserResource::make(Auth::user()));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        Auth::user()->update($request->validated());

        return success(null, status: 201);
    }
}
