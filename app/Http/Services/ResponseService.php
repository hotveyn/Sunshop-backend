<?php

namespace App\Http\Services;

use Carbon\Carbon;
use http\Message;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class ResponseService
{
    public static function success(mixed $data = null, int $code = 201, string $message = "successful"): Response|Application|ResponseFactory
    {
        return response([
            "status" => $code,
            "success" => true,
            "message" => $message,
            "data" => $data,
            "time" => Carbon::now()
        ], $code);
    }

    public static function error(int $code = 422, string $message = "unsuccessful", mixed $data = null): Response|Application|ResponseFactory
    {
        return response([
            "status" => $code,
            "success" => false,
            "message" => $message,
            "data" => $data,
            "time" => Carbon::now()
        ], $code);
    }
}
