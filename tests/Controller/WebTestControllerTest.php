<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WebTestControllerTest extends WebTestCase
{
    public function testHomeRedirectToWeb()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertResponseStatusCodeSame(302, 
                                            $client->getResponse()->getStatusCode());
    }

    public function testFakeWebResponseFromHome()
    {
        $client = static::createClient();
        $client->followRedirects();
        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $this->assertResponseFormatSame('json');
    }

    public function testErrorRedirectToWeb()
    {
        $client = static::createClient();
        $client->request('GET', '/error ');
        $this->assertResponseStatusCodeSame(302, 
                                            $client->getResponse()->getStatusCode());
    }

    public function testFakeWebResponseFromError()
    {
        $client = static::createClient();
        $client->followRedirects();
        $client->request('GET', '/error');
        $this->assertResponseIsSuccessful();
        $this->assertResponseFormatSame('json');
    }
}