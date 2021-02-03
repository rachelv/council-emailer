<?php

namespace App\Http\Controllers;

use App\Config;
use App\Env;
use App\Models\Campaign;
use Exception;
use SendGrid;

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

    public function sendEmail(string $slug)
    {
        if (!$this->isCampaignValid($slug)) {
            abort(404);
        }

        $campaign = Campaign::loadFromConfig($slug);

        $email = new SendGrid\Mail\Mail();

        $toEmails = [request()->get('to-email')];
        //if (Env::isLocal()) {
        $toEmails = ['rachel@magnetbox.org'];
        //}
        //if (Env::isProd()) {
        //    $toEmails = ['rachel@magnetbox.org', 'markvanakkeren@gmail.com', 'ericbudd@gmail.com'];
        //}
        foreach ($toEmails as $toEmail) {
            $email->addTo($toEmail);
        }

        $fromEmail = request()->get('from-email');
        $fromName = request()->get('from-name');
        // from has to be our domain for spam purposes, replyto can be user's email
        $email->setFrom('noreply@emailcitycouncil.com', $fromName);
        $email->setReplyTo($fromEmail, $fromName);

        $subject = request()->get('subject');
        $email->setSubject($subject);

        $message = request()->get('email-body');
        $email->addContent('text/plain', $message);

        $ccSender = request()->get('cc-sender');
        if ($ccSender) {
            $email->addCc($fromEmail);
        }

        $bccLocalOrg = request()->get('bcc-local-org');
        if ($bccLocalOrg) {
            $orgEmail = Config::getCampaignConfig($slug, 'org-email');
            $email->addBcc($orgEmail);
        }

        // get 100 free email/day with sendgrid, update to use SES if that becomes a problem
        try {
            $mailer = new SendGrid('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');
            $response = $mailer->send($email);
        } catch (Exception $e) {
            // todo
        }

        dd($response);

        // todo: success msg
        return redirect($campaign->getUrl());
    }

    private function isCampaignValid(string $slug): bool
    {
        return Config::isCampaignValid($slug);
    }
}
