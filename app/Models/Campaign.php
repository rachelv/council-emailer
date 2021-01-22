<?php

namespace App\Models;

// "fake" model, does not sit on top of a database table for now
class Campaign
{
    private string $title = '';

    public static function loadFromConfig(string $key): Campaign {
        $config = config($key);

        $campaign = new Campaign();
        $campaign->setTitle($config['title']);

        return $campaign;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function getTitle(): string {
        return $this->title;
    }
}
