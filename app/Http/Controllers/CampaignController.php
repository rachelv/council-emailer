<?php

namespace App\Http\Controllers;

use App\Config;
use App\Env;
use App\Models\Campaign;

class CampaignController extends Controller
{
    /**
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function campaign(string $slug)
    {
        if (!$this->isCampaignValid($slug)) {
            abort(404);
        }

        $campaign = Campaign::loadFromConfig($slug);

        return view('campaign.index', [
            'campaign' => $campaign
        ]);
    }

    public function send(string $slug)
    {
        if (!$this->isCampaignValid($slug)) {
            abort(404);
        }

        $campaign = Campaign::loadFromConfig($slug);

        $toEmails = [request()->get('to-email')];
        if (Env::isLocal()) {
            $toEmails = ['rachel@magnetbox.org'];
        }
        if (Env::isProd()) {
            $toEmails = ['rachel@magnetbox.org', 'markvanakkeren@gmail.com', 'ericbudd@gmail.com'];
        }

        $fromEmail = request()->get('from-email');
        $fromName = request()->get('from-name');
        if (!empty($fromName)) {
            $fromEmail = "{$fromName} <{$fromEmail}>";
        }
        $headers[] = "From: {$fromEmail}";

        $subject = request()->get('subject');

        $message = request()->get('email-body');

        $ccSender = request()->get('cc-sender');
        if ($ccSender) {
            $headers[] = "Cc: {$fromEmail}";
        }

        $bccLocalOrg = request()->get('bcc-local-org');
        if ($bccLocalOrg) {
            $orgEmail = Config::getCampaignConfig($slug, 'org-email');
            $headers[] = "Bcc: {$orgEmail}";
        }

        // ridiculously not scalable but fine for now
        // will do the work to get this on SES if it starts to matter
        foreach ($toEmails as $toEmail) {
            mail($toEmail, $subject, $message, $headers);
        }

        // todo: success msg
        return request()->redirect($campaign->getUrl());
    }

    private function isCampaignValid(string $slug): bool
    {
        return Config::isCampaignValid($slug);
    }
}
