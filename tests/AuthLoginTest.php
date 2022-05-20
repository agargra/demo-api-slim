<?php

namespace Tests;

class AuthLoginTest extends BaseTestCase
{
    public function testLogin(): void
    {
        $response = $this->runApp('POST', '/login', ['email' => 'test@user.com', 'password' => 'The#Pass']);

        $result = (string) $response->getBody();
        
        self::$jwt = json_decode($result)->message->Authorization;

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('Authorization', $result);
        $this->assertStringContainsString('Bearer', $result);
    }
}