<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Http\Services\ResponseService;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function store(UserStoreRequest $request): Response|Application|ResponseFactory
    {
        $user = User::create($request->validated());
        if ($user->save()) {
            return ResponseService::success(UserResource::make($user));
        }

        return ResponseService::error();
    }

    public function login(UserLoginRequest $request): Response|Application|ResponseFactory
    {
        if (auth()->attempt($request->validated())) {
            $user = auth()->user();
            $user->api_token = Str::uuid();
            $user->save();
            return ResponseService::success([
                "token" => $user->api_token,
                "expires_time" => Carbon::now()->addDay()
            ], 200);
        }
        return ResponseService::error(401, 'Incorrect credentials');
    }

    //todo: Доделать код ошибки
    public function session(): Response|Application|ResponseFactory
    {
        return ResponseService::success(UserResource::make(auth()->user()), 200);
    }

    //todo: Доделать код ошибки
    public function logout(): Response|Application|ResponseFactory
    {
        $user = auth()->user();
        $user->api_token = null;
        auth()->logout();
        return ResponseService::error(data: UserResource::make($user));
    }
}
