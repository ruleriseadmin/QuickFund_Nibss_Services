<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    $response = [
        "success" => true,
        "message" => 'Welcome to the API!'
    ];
    return Response::json($response);
});
