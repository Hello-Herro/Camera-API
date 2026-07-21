<?php

use App\Http\Controllers\Api\CameraController;
use Illuminate\Support\Facades\Route;

Route::apiResource('cameras', CameraController::class);
