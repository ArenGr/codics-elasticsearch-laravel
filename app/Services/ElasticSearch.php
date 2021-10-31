<?php
namespace App\Services;

use App\Models\User;
use Elasticsearch\Client;
use Illuminate\Support\Arr;

class ElasticSearch
{
    private $elasticsearch;

    private $userModel;

    public function __construct(Client $elasticsearch, User $user)
    {
        $this->elasticsearch = $elasticsearch;
        $this->userModel = $user;
    }

    public function search(array $query = [])
    {
        return $this->buildCollection(
            $this->searchOnElasticsearch($query)
        );
    }

    private function searchOnElasticsearch(array $query = [])
    {
        return $this->elasticsearch->search([
            'index' => $this->userModel->getSearchIndex(),
            'body'  => [
                'query' => [
                    'bool' => [
                        'must' => [
                            $query
                        ]
                    ]
                ]
            ]
        ]);
    }

    private function buildCollection (array $items)
    {
        $ids = Arr::pluck($items['hits']['hits'], '_id');
        return User::whereIn('id', $ids)->get();
    }
}
