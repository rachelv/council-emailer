<?php

namespace App\Models;

use Illuminate\Support\Collection;

// "fake" model, does not sit on top of a database table for now
class Campaign
{
    private string $title = '';
    private string $slug = '';
    private string $orgName = '';
    private string $orgEmail = '';
    private array $talkingPoints = [];

    public static function loadFromConfig(string $slug, array $config): Campaign
    {
        $campaign = new Campaign();
        $campaign->setSlug($slug);
        $campaign->setTitle($config['title']);
        $campaign->setOrgName($config['org-name']);
        $campaign->setOrgEmail($config['org-email']);
        $campaign->setTalkingPoints($config['talking-points']);

        return $campaign;
    }

    public function getUrl(): string
    {
        return route('campaign', ['slug' => $this->getSlug()]);
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setOrgName(string $orgName): void
    {
        $this->orgName = $orgName;
    }

    public function getOrgName(): string
    {
        return $this->orgName;
    }

    public function setOrgEmail(string $orgEmail): void
    {
        $this->orgEmail = $orgEmail;
    }

    public function getOrgEmail(): string
    {
        return $this->orgEmail;
    }

    public function setTalkingPoints(array $talkingPoints): void
    {
        $this->talkingPoints = $talkingPoints;
    }

    public function getTalkingPoints(): Collection
    {
        return collect($this->talkingPoints);
    }
}
