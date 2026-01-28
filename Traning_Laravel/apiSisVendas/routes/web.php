<?php

use Illuminate\Support\Facades\Route;


# importando as controllers para a nossa API
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;


Route::get('/', function () {
    return view('welcome');
});

