<?php

if (!function_exists('buildMatchQuery')) {

    function buildMatchQuery($params, $fields)
    {
        $query = array();

        foreach ($fields as $key => $field) {

            $subQuery = array();

            $subQuery[$field] = $params[$key];

            array_push($query, array('match' => $subQuery));
        }

        return $query;
    }
}

if (!function_exists('buildTermQuery')) {

    function buildTermQuery($fields)
    {
        $query = array();

        foreach ($fields as $key => $field) {

            $subQuery = array();

            $subQuery[$key] = $field;

            array_push($query, array('term' => $subQuery));
        }

        return $query;
    }
}
