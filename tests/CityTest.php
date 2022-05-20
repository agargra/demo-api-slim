<?php

namespace Tests;

class CityTest extends BaseTestCase
{
    private static array $data = [
      'idOK'      => 'ESMX0001',
      'idKO'      => 'UNKNOWNID',
      'orderByKO' => 'UnknownProp'
    ];

    public function testGetCities(): void
    {
        $response = $this->runApp('GET', '/api/v1/cities');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('message', $result);
        $this->assertStringNotContainsString('error', $result);
    }
    
    public function testGetCitiesByName(): void
    {
        $response = $this->runApp('GET', '/api/v1/cities?orderBy=name');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('message', $result);
        $this->assertStringNotContainsString('error', $result);
    }    

    public function testGetCitiesByUnknown(): void
    {
        $response = $this->runApp('GET', '/api/v1/cities?orderBy=' . self::$data['orderByKO']);

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals('application/problem+json', $response->getHeaderLine('Content-Type'));
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringContainsString('error', $result);
    }    


    public function testGetCity(): void
    {
        $response = $this->runApp('GET', '/api/v1/cities/' . self::$data['idOK']);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('forecast', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetCityNotFound(): void
    {
        $response = $this->runApp('GET', '/api/v1/cities/' . self::$data['idKO']);

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('application/problem+json', $response->getHeaderLine('Content-Type'));
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringContainsString('error', $result);
    }

}