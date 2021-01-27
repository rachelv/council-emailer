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
            /** @var $campaign Campaign */
            $campaign = Campaign::loadFromConfig($slug, $configData);
            if ($campaign->getActive()) {
                $campaigns->push($campaign);
            }
        }

        return view('index', [
            'campaigns' => $campaigns
        ]);
    }
}
