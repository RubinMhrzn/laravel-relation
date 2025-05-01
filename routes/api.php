<?php

use App\Http\Controllers\PassportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    $data = [
        'name' => 'abc',
        'email' => 'abc@gmail.com'
    ];

    /*
    200 ok
    201 created
    400 Bad Request
    500 Server Error
    */
    return response()->json([
        'status_code' => 200,
        'data' => $data,
        'message' => 'Record fetch successfully'
    ]);
});

Route::post('/login', [PassportController::class, 'login']);

Route::group(['middleware' => ['auth:api'], 'prefix' => '', 'as' => ''], function () {
    Route::get('/get-user', [PassportController::class, 'getUser']);
});
