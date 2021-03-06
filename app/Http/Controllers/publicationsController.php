<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Elasticsearch\ClientBuilder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;


class publicationsController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
    return view('publications.index', compact('data', 'paginator'));
  }

  public function record( $id) {

    $params = [
      'index' => 'ciim',
      'body' => [
        "query" => [
          "bool" => [
              "must" => [
                 [
                      "match" => [
                        "admin.id" => $id
                      ]
                 ],
                 [
                      "term"=> [ "type.base" => 'publication']
                 ]
              ]
           ]
        ]
      ],
    ];
    $response = $this->getElastic()->setParams($params)->getSearch();
    $data = $response['hits']['hits'];

    $paramsTerm = [
      'index' => 'ciim',
      'size' => 3,
      'body' => [
        "query" => [
          "bool" => [
              "must" => [
                 [
                      "match" => [
                        "reference_links" => $id
                      ]
                 ],
                 [
                      "term"=> [ "type.base" => 'object']
                 ]
              ]
           ]
        ]
      ],

    ];
    $response2 = $this->getElastic()->setParams($paramsTerm)->getSearch();
    $use = $response2['hits'];

    return view('publications.record', compact('data', 'use'));
  }
}
