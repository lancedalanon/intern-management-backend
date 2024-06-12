<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('/login', [AuthController::class, 'login']);

Route::patch('/personal-information', [UserController::class, 'updatePersonalInformation']);
