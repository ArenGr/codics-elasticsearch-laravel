<?php

namespace App\Http\Controllers;

use App\Services\ElasticSearch;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchByName(Request $request, ElasticSearch $elasticSearch)
    {
        $name = $request->input('name');

        $query = buildMatchQuery(array($name), array('name'));

        $users = $elasticSearch->search($query);

        return response()->json($users);
    }

    public function searchBySurname(Request $request, ElasticSearch $elasticSearch)
    {
        $surname = $request->input('surname');

        $query = buildMatchQuery(array($surname), array('surname'));

        $users = $elasticSearch->search($query);

        return response()->json($users);
    }

    public function searchByFullname(Request $request, ElasticSearch $elasticSearch)
    {
        $name = $request->input('name');
        $surname = $request->input('surname');

        $query = buildMatchQuery(array($name, $surname), array('name', 'surname'));

        $users = $elasticSearch->search($query);

        return response()->json($users);
    }

}
