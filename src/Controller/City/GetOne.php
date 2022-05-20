<?php
namespace App\Controller\City;

use Slim\Http\Request;
use Slim\Http\Response;

final class GetOne extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $input = (array) $request->getParsedBody();
        $cityId = (string) $args['id'];

        $city = $this->getCityService()->getOne($cityId);
        $city->forecast = $this->getForecastService()->getTemperaturesByCity($cityId);

        return $this->jsonResponse($response, 'success', $city, 200);
    }
}