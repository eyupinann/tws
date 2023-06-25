<?php

namespace App\Http\Custom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Response
{
    private $status, $message, $data;

    public static function withData($status, $message, $data)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ],\Symfony\Component\HttpFoundation\Response::HTTP_OK);
    }

    public static function withoutData($status, $message)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => new \stdClass()
        ],\Symfony\Component\HttpFoundation\Response::HTTP_UNAUTHORIZED);
    }
}
