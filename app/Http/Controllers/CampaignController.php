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

        $isTestMode = $this->getIsTestMode();

        $campaign = Campaign::loadFromConfig($slug);

        $toEmails = $this->getToEmails($isTestMode);

        return view('campaign.index', [
            'campaign' => $campaign,
            'toEmails' => $toEmails,
            'isTestMode' => $isTestMode,
        ]);
    }

    public function sendEmail(string $slug)
    {
        if (!$this->isCampaignValid($slug)) {
            abort(404);
        }

        $isTestMode = $this->getIsTestMode();

        $campaign = Campaign::loadFromConfig($slug);

        $email = new SendGrid\Mail\Mail();

        $toEmails = $this->getToEmails($isTestMode);
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

        $success = true;

        // get 100 free email/day with sendgrid, update to use SES if that becomes a problem
        try {
            $mailer = new SendGrid(env('SENDGRID_API_KEY'));
            $response = $mailer->send($email);
        } catch (Exception $e) {
            $success = false;
            request()->session()->flash('error', "There was a problem sending your email: {$e->getMessage()}");
        }

        if ($success) {
            request()->session()->flash('success', "Thanks for sending an email to city council as part of the {$campaign->getTitle()} campaign.");
        }

        return redirect($campaign->getUrl());
    }

    private function getIsTestMode(): bool
    {
        $test = request()->get('test');
        return boolval($test);
    }

    private function getToEmails(bool $isTestMode): array
    {
        // defaults to full city council
        $toEmails = [Config::getGlobalConfig('full-council-email')];

        // local: always rachel
        if (Env::isLocal()) {
            $toEmails = ['rachel.vecchitto@gmail.com'];
        }
        if (Env::isProd() && $isTestMode) {
            $toEmails = ['rachel.vecchitto@gmail.com', 'markvanakkeren@gmail.com', 'ericbudd@gmail.com'];
        }

        return $toEmails;
    }

    private function isCampaignValid(string $slug): bool
    {
        return Config::isCampaignValid($slug);
    }
}
