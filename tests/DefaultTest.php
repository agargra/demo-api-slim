<?php

namespace Tests;

class DefaultTest extends BaseTestCase
{
    public function testApiHelp(): void
    {
        $response = $this->runApp('GET', '/');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('status', $result);
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('version', $result);
        $this->assertStringContainsString('time', $result);
        $this->assertStringContainsString('endpoints', $result);
        $this->assertStringContainsString('help', $result);
        $this->assertStringNotContainsString('error', $result);
        $this->assertStringNotContainsString('Failed', $result);
    }
    public function testRouteNotFound(): void
    {
        $response = $this->runApp('GET', '/route-not-found');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('application/problem+json', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('error', $result);
    }
}