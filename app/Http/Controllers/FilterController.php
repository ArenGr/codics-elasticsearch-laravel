<?php

namespace App\Http\Controllers;

use App\Services\ElasticFilter;
use App\Services\ElasticSearch;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filter(Request $request, ElasticFilter $elasticFilter)
    {
        $fileds = $request->all();

        $query = buildTermQuery($fileds);

        $users = $elasticFilter->filter($query);

        return response()->json($users);
    }
}
