<?php

namespace Recoco\Domain\Gnavi\Service;

use Recoco\Domain\Api\Service\QueryBuilderInterface;
use GuzzleHttp\Client

class GnaviApiService {

    private $url;
    private $method = 'GET';
    private $format = 'json';
    private $config;
    private $queryBuilder;

    public function __construct()
    {
    }

    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setConfig ($config)
    {
        $this->config = $config;

        return $this;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function setQueryBuilder(QueryBuilderInterface $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;

        return $this;
    }

    public function execute()
    {
        $query = $this->queryBuilder->getQuery();

        $query['keyid'] = $this->config->getKeyId();
        $query['format'] = $this->getFormat();

        $client = new Client();

        $response = $client->request($this->getMethod(), $this->getUrl(), [
            'verify' => false,
            'query' => $query
        ]);

        return $response;
    }

}
