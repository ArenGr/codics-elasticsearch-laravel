<?php

namespace App\Traits;

trait Searchable
{

    public static function bootSearchable()
    {
        static::observe(\App\Observers\ElasticsearchObserver::class);
    }

    public function getSearchIndex(): string
    {
        return $this->getTable();
//        return 'users';
    }

    public function getSearchType(): string
    {
        return '_doc';
    }

    public function toSearchArray(): array
    {
        return $this->toArray();
    }
}
