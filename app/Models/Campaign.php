<?php

namespace App\Models;

// "fake" model, does not sit on top of a database table for now
class Campaign
{
    private string $title = '';
    private string $orgName = '';
    private string $orgEmail = '';
    private object $talkingPoints;

    public static function loadFromConfig(string $key): Campaign {
        $config = config($key);

        $campaign = new Campaign();
        $campaign->setTitle($config['title']);
        $campaign->setOrgName($config['org-name']);
        $campaign->setOrgEmail($config['org-email']);

        return $campaign;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setOrgName(string $orgName): void {
        $this->orgName = $orgName;
    }

    public function getOrgName(): string {
        return $this->orgName;
    }

    public function setOrgEmail(string $orgEmail): void {
        $this->orgEmail = $orgEmail;
    }

    public function getOrgEmail(): string {
        return $this->orgEmail;
    }
}
