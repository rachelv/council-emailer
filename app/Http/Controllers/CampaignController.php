<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class CampaignController extends Controller
{
    /**
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function campaign($slug)
    {
        return view('campaign.index');
    }
}