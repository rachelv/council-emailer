<?php

namespace App;

use Illuminate\Support\Collection;

class Config
{
    public static function isCampaignValid($slug): bool
    {
        return config()->has("campaigns.{$slug}");
    }

    public static function getCampaignConfig(string $slug, string $key): mixed
    {
        return config("campaigns.{$slug}.{$key}");
    }

    public static function getGlobalConfig(string $key): mixed
    {
        return config("council-emailer.{$key}");
    }

    public static function getAllCampaignKeys(): Collection
    {
        return collect(array_keys(config('campaigns')));
    }
}
