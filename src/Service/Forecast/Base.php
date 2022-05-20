<?php

namespace App\Service\Forecast;

use App\Service\BaseService;
use GuzzleHttp\Client;

abstract class Base extends BaseService
{
    protected Client $httpClient;

    public function __construct() 
    {
        $this->httpClient = new Client();
    }

    protected function getHttpClient(): Client
    {
        return $this->httpClient;
    }

}