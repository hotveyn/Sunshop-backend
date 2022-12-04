<?php

namespace App\Http\Controllers\User\StaffType;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserModifyRequest;
use App\Http\Requests\UserPageRequest;
use App\Http\Resources\UserResource;
use App\Http\Services\ResponseService;
use App\Models\User;

class UserController extends Controller
{
    public function update(UserModifyRequest $request, User $id)
    {
        $id->fill($request->validated());
        $id->save();

        return ResponseService::success(UserResource::make($id), 200);
    }

    public function infoOne(User $id)
    {
        return ResponseService::success(UserResource::make($id), 200);
    }

    public function delete(User $id)
    {
        $id->delete();
        return ResponseService::success(UserResource::make($id), 200);
    }

    public function infoPaged(UserPageRequest $request)
    {
        $users = User::query()
            ->skip($request->skip)
            ->take($request->take)
            ->get();

        return ResponseService::success([
            "items" => UserResource::collection($users),
            "count" => $users->count(),
            "skip" => $request->skip
        ], 200);
    }

    public function info()
    {
        $users = User::all();
        return ResponseService::success([
            "items" => UserResource::collection($users),
            "count" => $users->count(),
            "skip" => 0
        ], 200);
    }
}
