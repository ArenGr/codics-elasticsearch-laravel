<?php

namespace App\Console\Commands;

use App\Models\User;
use Elasticsearch\Client;
use Illuminate\Console\Command;

class ReindexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature='search:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description='Indexes all users to Elasticsearch';


    private $elasticsearch;
    private $user;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Client $elasticsearch, User $user)
    {
        parent::__construct();
        $this->elasticsearch=$elasticsearch;
        $this->user=$user;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Indexing all users. This might take a while...');

        try {
            $this->elasticsearch->indices()->delete(['index'=>$this->user->getSearchIndex()]);
        } catch (\Exception $e) {

        }

        $this->elasticsearch->indices()->create($this->settings($this->user));

        foreach (User::cursor() as $user) {
            $this->elasticsearch->index([
                'index'=>$user->getSearchIndex(),
                'type'=>$user->getSearchType(),
                'id'=>$user->getKey(),
                'body'=>$user->toSearchArray(),
            ]);
            $this->output->write('.');
        }

        $this->info('\nDone!');
    }

    private function settings($user)
    {
        return [
            'index'=>$user->getSearchIndex(),
            'body'=>[
                "mappings"=>[
                    "users"=>[
                        "properties"=>[
                            "name"=>[
                                "type"=>"text",
                                "fields" => [
                                    "raw" => [
                                        "type" => "keyword"
                                    ]
                                ]
                            ],
                            "surname"=>[
                                "type"=>"text",
                                "fields" => [
                                    "raw" => [
                                        "type" => "keyword"
                                    ]
                                ]
                            ],
                            "age"=>[
                                "type"=>"byte",
                                "fields" => [
                                    "raw" => [
                                        "type" => "keyword"
                                    ]
                                ]
                            ],
                            "country"=>[
                                "type"=>"text",
                                "fields" => [
                                    "raw" => [
                                        "type" => "keyword"
                                    ]
                                ]
                            ],
                            "created" =>  [
                                "type" =>   "date",
                                "format" => "strict_date_optional_time||epoch_millis"
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
}
