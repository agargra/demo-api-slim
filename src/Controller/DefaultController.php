<?php
namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

final class DefaultController extends BaseController
{
    private const API_VERSION = '1.0.0';

    public function getHelp(Request $request, Response $response): Response
    {
        $app = $this->container->get('settings')['app'];
        $endpoints = [
            'cities' => '/api/v1/cities',
            'help' => 'List of cities',
        ];
        $message = [
            'endpoints' => $endpoints,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

        return $this->jsonResponse($response, 'success', $message, 200);
    }

}