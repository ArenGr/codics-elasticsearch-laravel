<?php

namespace App\Services;

use App\Models\User;
use Elasticsearch\Client;
use Illuminate\Support\Arr;

class ElasticFilter
{
    private $elasticsearch;

    private $userModel;

    public function __construct(Client $elasticsearch, User $user)
    {
        $this->elasticsearch=$elasticsearch;
        $this->userModel=$user;
    }

    public function filter(array $query=[])
    {
        return $this->buildCollection(
            $this->searchOnElasticsearch($query)
        );
    }

    private function searchOnElasticsearch(array $query=[])
    {
        return $this->elasticsearch->search([
            'index'=>$this->userModel->getSearchIndex(),
            "body"=>[
                "query"=>[
                    "bool"=>[
                        "filter"=>[
//                            [
//                                "term"=>["age"=>"2"]
                                $query
//                            ],
                        ]
                    ]
                ]
            ]
        ]);
    }

    private function buildCollection(array $items)
    {
        $ids=Arr::pluck($items['hits']['hits'], '_id');
        return User::whereIn('id', $ids)->get();
    }
}
