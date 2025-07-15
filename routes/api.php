<?php

use App\Http\Controllers\Api\RealEstatePropertyController;
use Illuminate\Support\Facades\Route;

Route::apiResource('real-estates', RealEstatePropertyController::class);
