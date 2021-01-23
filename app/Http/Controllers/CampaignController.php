<?php

namespace App\Http\Controllers;

use App\Models\Campaign;

class CampaignController extends Controller
{
    /**
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function campaign(string $slug)
    {
        $baseKey = "campaigns.{$slug}";

        if (!config()->has($baseKey)) {
            abort(404);
        }

        $campaign = Campaign::loadFromConfig($slug, config($baseKey));

        return view('campaign.index', [
            'campaign' => $campaign
        ]);
    }
}
