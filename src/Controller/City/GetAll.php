<?php
namespace App\Controller\City;

use Slim\Http\Request;
use Slim\Http\Response;

final class GetAll extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $input = (array) $request->getParsedBody();
        $orderBy = $request->getQueryParam('orderBy', 'id');

        $cities = $this->getCityService()->getAll($orderBy);

        return $this->jsonResponse($response, 'success', $cities, 200);
    }
}