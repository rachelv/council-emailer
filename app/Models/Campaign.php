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
    private array $localOrgs = [];
    private array $exampleSubjects = [];
    private array $references = [];
    private array $talkingPoints = [];
    private array $asks = [];

    public static function loadFromConfig(string $slug): Campaign
    {
        $campaign = new Campaign();
        $campaign->setSlug($slug);
        $campaign->setActive(boolval(Config::getCampaignConfig($slug, 'active')));
        $campaign->setTitle(Config::getCampaignConfig($slug, 'title'));
        $campaign->setLocalOrgs(Config::getCampaignConfig($slug, 'local-orgs'));
        $campaign->setExampleSubjects(Config::getCampaignConfig($slug, 'example-subjects'));
        $campaign->setReferences(Config::getCampaignConfig($slug, 'references'));
        $campaign->setTalkingPoints(Config::getCampaignConfig($slug, 'talking-points'));
        $campaign->setAsks(Config::getCampaignConfig($slug, 'asks'));

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

    public function setLocalOrgs(array $localOrgs): void
    {
        $this->localOrgs = $localOrgs;
    }

    public function getLocalOrgs(): Collection
    {
        return collect($this->localOrgs);
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

    public function setAsks(array $asks): void
    {
        $this->asks = $asks;
    }

    public function getAsks(): Collection
    {
        return collect($this->asks);
    }

    public function hasAsks(): bool
    {
        return count($this->asks) > 0;
    }

    public function setTalkingPoints(array $talkingPoints): void
    {
        $this->talkingPoints = $talkingPoints;
    }

    public function getTalkingPoints(): Collection
    {
        return collect($this->talkingPoints);
    }

    public function hasTalkingPoints(): bool
    {
        return count($this->talkingPoints) > 0;
    }

    public function setReferences(array $references): void
    {
        $this->references = $references;
    }

    public function getReferences(): Collection
    {
        return collect($this->references);
    }

    public function hasReferences(): bool
    {
        return count($this->references) > 0;
    }
}
