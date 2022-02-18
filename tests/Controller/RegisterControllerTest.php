<?php

namespace App\Tests\Controller;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class RegisterControllerTest extends ApiTestCase
{
    private $options = [];

    protected function setUp() : void {
        $headers = [];
        $headers['Content-Type'] = 'application/json';
        $this->options = [];
        $this->options['headers'] = $headers;
    }
    public function testRegister(): void
    {
        $this->options['json'] = ['email' => 'email@gmail.com',
            'password'  => '1234567Aa*'];
        static::createClient()->request('POST', '/register',$this->options);
        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['user' => 'email@gmail.com']);
    }

    public function testWrongEmailRegister(): void
    {
        $this->options['json'] = ['email' => 'email.gmail.com',
            'password'  => '1234567Aa*'];
        $response = static::createClient()->request('POST', '/register',$this->options);
        $this->assertResponseIsSuccessful();
        $data = json_decode($response->getContent(), true);
        $this->assertIsArray($data);
        $this->assertArrayHasKey('exception',$data);
    }

    public function testBlankEmailRegister(): void
    {
        $this->options['json'] = ['email' => '',
            'password'  => '1234567Aa*'];
        $response = static::createClient()->request('POST', '/register',$this->options);
        $this->assertResponseIsSuccessful();
        $data = json_decode($response->getContent(), true);
        $this->assertIsArray($data);
        $this->assertArrayHasKey('exception',$data);
    }

    public function testBlankPasswordRegister(): void
    {
        $this->options['json'] = ['email' => 'email@email.com',
            'password'  => ''];
        $response = static::createClient()->request('POST', '/register',$this->options);
        $this->assertResponseIsSuccessful();
        $data = json_decode($response->getContent(), true);
        $this->assertIsArray($data);
        $this->assertArrayHasKey('exception',$data);
    }

    public function testShortLengthPasswordRegister(): void
    {
        $this->options['json'] = ['email' => 'email@email.com',
            'password'  => '1234'];
        $response = static::createClient()->request('POST', '/register',$this->options);
        $this->assertResponseIsSuccessful();
        $data = json_decode($response->getContent(), true);
        $this->assertIsArray($data);
        $this->assertArrayHasKey('exception',$data);
    }

    public function testNoLetterPasswordRegister(): void
    {
        $this->options['json'] = ['email' => 'email@email.com',
            'password'  => '12345678*'];
        $response = static::createClient()->request('POST', '/register',$this->options);
        $this->assertResponseIsSuccessful();
        $data = json_decode($response->getContent(), true);
        $this->assertIsArray($data);
        $this->assertArrayHasKey('exception',$data);
    }

    public function testNoCaseDiffPasswordRegister(): void
    {
        $this->options['json'] = ['email' => 'email@email.com',
            'password'  => '12345678*a'];
        $response = static::createClient()->request('POST', '/register',$this->options);
        $this->assertResponseIsSuccessful();
        $data = json_decode($response->getContent(), true);
        $this->assertIsArray($data);
        $this->assertArrayHasKey('exception',$data);
    }

    public function testNoSpecialCharPasswordRegister(): void
    {
        $this->options['json'] = ['email' => 'email@email.com',
            'password'  => '12345678aA'];
        $response = static::createClient()->request('POST', '/register',$this->options);
        $this->assertResponseIsSuccessful();
        $data = json_decode($response->getContent(), true);
        $this->assertIsArray($data);
        $this->assertArrayHasKey('exception',$data);
    }
}
