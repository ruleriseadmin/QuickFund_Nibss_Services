<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\NibssController;

Route::get('/', function () {
    $response = [
        "success" => true,
        "message" => 'Welcome to the API!'
    ];
    return Response::json($response);
});


Route::post('/bvn/verify', [NibssController::class, 'verifyBVN']);
