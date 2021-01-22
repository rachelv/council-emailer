<?php

use App\Http\Controllers\CampaignController;
use Illuminate\Support\Facades\Route;

// todo: list campaigns I guess
Route::get('/', function () {
    return 'hello index';
});

Route::get('/campaign/{slug}', [CampaignController::class, 'campaign']);