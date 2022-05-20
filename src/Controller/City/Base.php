<?php
namespace App\Controller\City;

use App\Controller\BaseController;
use App\Exception\City;
use App\Service\City\CityService;
use App\Service\Forecast\PelmorexService;

abstract class Base extends BaseController
{
    protected function getCityService(): CityService
    {
        return $this->container->get('city_service');
    }

    protected function getForecastService(): PelmorexService
    {
        return $this->container->get('forecast_service');
    }
}