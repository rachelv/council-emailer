<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $allCampaigns = config('campaigns');

        $campaigns = collect();

        foreach ($allCampaigns as $slug => $configData) {
            $campaigns->push(Campaign::loadFromConfig($slug, $configData));
        }

        return view('index', [
            'campaigns' => $campaigns
        ]);
    }
}
