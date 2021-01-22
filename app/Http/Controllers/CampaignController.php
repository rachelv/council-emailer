<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Support\Facades\Log;

class CampaignController extends Controller
{
    /**
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function campaign($slug)
    {
        $baseKey = "campaigns.{$slug}";

        if(!config()->has($baseKey)) {
            abort(404);
        }

        $campaign = Campaign::loadFromConfig($baseKey);

        return view('campaign.index', [
            'campaign' => $campaign
        ]);
    }
}