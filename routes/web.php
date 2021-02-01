<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\CampaignController;
use Illuminate\Support\Facades\Route;

Route::get('/', [Controller::class, 'index'])
    ->name('index');

Route::get('/campaign/{slug}', [CampaignController::class, 'campaign'])
    ->name('campaign');

Route::post('/campaign/{slug}/send', [CampaignController::class, 'sendEmail'])
    ->name('campaignSendEmail');
