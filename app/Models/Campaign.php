<?php

namespace App\Models;

use App\Config;
use Illuminate\Support\Collection;

// "fake" model, does not sit on top of a database table for now
class Campaign
{
    private bool $active = false;
    private string $title = '';
    private string $slug = '';
    private string $orgName = '';
    private string $orgEmail = '';
    private array $exampleSubjects = [];
    private array $talkingPoints = [];

    public static function loadFromConfig(string $slug): Campaign
    {
        $campaign = new Campaign();
        $campaign->setSlug($slug);
        $campaign->setActive(boolval(Config::getCampaignConfig($slug, 'active')));
        $campaign->setTitle(Config::getCampaignConfig($slug, 'title'));
        $campaign->setOrgName(Config::getCampaignConfig($slug, 'org-name'));
        $campaign->setOrgEmail(Config::getCampaignConfig($slug, 'org-email'));
        $campaign->setExampleSubjects(Config::getCampaignConfig($slug, 'example-subjects'));
        $campaign->setTalkingPoints(Config::getCampaignConfig($slug, 'talking-points'));

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

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function getActive(): bool
    {
        return $this->active;
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

    public function setExampleSubjects(array $exampleSubjects): void
    {
        $this->exampleSubjects = $exampleSubjects;
    }

    public function getExampleSubjects(): Collection
    {
        return collect($this->exampleSubjects);
    }

    public function getExampleSubjectsJson(): string
    {
        return json_encode($this->exampleSubjects);
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
