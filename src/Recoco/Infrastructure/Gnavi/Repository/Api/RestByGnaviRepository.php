<?php

namespace Recoco\Infrastructure\Gnavi\Repository\Api;

use Recoco\Domain\Gnavi\Repository\RestByGnaviRepositoryInterface;
use Recoco\Domain\Gnavi\Criteria\RestSearchByGnavi;

use GuzzleHttp\Client;

class RestByGnaviRepository implements RestByGnaviRepositoryInterface
{
    const BASE_URL = 'https://api.gnavi.co.jp/RestSearchAPI/20150630/';

    public function getRestsByGnavi(RestSearchByGnavi $restSearchByGnavi)
    {
        $client = new Client();
        $response = $client->request('GET', self::BASE_URL, [
            'verify' => false,
            'query' => $restSearchByGnavi->toArray(),
        ]);

        $rests = [];
        if($response->getStatusCode() == 200) {
            $stream = $response->getBody();
            $apiResponse = json_decode($stream);
            if(!is_null($apiResponse)) {
                $rests = $apiResponse->rest;
            }
        }

        return $rests;
    }

    public function getCountPageRestsByGnavi(RestSearchByGnavi $restSearchByGnavi)
    {
        $totalPage = 0;

        $client = new Client();
        $response = $client->request('GET', self::BASE_URL, [
            'verify' => false,
            'query' => $restSearchByGnavi->toArray(),
        ]);

        $rests = [];
        if($response->getStatusCode() == 200) {

            $stream = $response->getBody();
            $apiResponse = json_decode($stream);
            if(!is_null($apiResponse)) {
                $totalHitCount = $apiResponse->total_hit_count;

                $totalPage = ($apiResponse->total_hit_count % $apiResponse->hit_per_page == 0)
                    ? (int) floor($apiResponse->total_hit_count / $apiResponse->hit_per_page)
                    : (int) floor($apiResponse->total_hit_count / $apiResponse->hit_per_page) + 1;
            }
        }

        return $totalPage;
    }
}
