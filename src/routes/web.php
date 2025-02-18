<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::get("tests/test", [TestController::class, "index"]);

Route::get('/', function () {
    return view('welcome');
});
