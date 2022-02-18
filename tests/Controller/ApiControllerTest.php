<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use App\DataFixtures\AppFixtures;
use App\Repository\UserRepository;

class ApiControllerTest extends WebTestCase
{
    private $client;
    private $server = [];

    public function setUp(): void {

        parent::setUp();
        $this->client = static::createClient();
        $entityManager = static::getContainer()->get('doctrine')->getManager();
        $hasher = static::getContainer()->get(UserPasswordHasherInterface::class);
        $fixture = new AppFixtures($hasher);
        $fixture->load($entityManager);
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('email@email.com');
        $this->client->loginUser($testUser);
        $this->server["CONTENT_TYPE"] = "application/json";
        $content = '{
            "email": "email@email.com",
            "password": "abcd1234*"
        }';
        $this->client->request('POST', '/login',[],[],$this->server,$content);
        $this->assertResponseIsSuccessful();
        $data = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertIsArray($data);
        $this->assertArrayHasKey('message',$data);
        $this->assertEquals($data['message'],'success!');
        $this->server["HTTP_X-AUTH-TOKEN"] = $data['token'];
    }

    /*
    * @depends setUp
    */
    public function testApiAccess(): void
    {
        $this->client->request('GET','/api/test',[],[],$this->server);
        $this->assertResponseIsSuccessful();
        $data = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertIsArray($data);
        $this->assertArrayHasKey('message',$data);
        $this->assertEquals($data['message'],'Welcome to your new controller!');
        $this->assertEquals($data['path'],'src/Controller/ApiController.php');
    }
}
