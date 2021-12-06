<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use App\DataFixtures\AppFixtures;
use App\Repository\UserRepository;

class LoginControllerTest extends WebTestCase
{

    public function testLogin(): void
    {
        $client = static::createClient();
        $entityManager = static::getContainer()->get('doctrine')->getManager();
        $hasher = static::getContainer()->get(UserPasswordHasherInterface::class);
        $fixture = new AppFixtures($hasher);
        $fixture->load($entityManager);
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('email@email.com');
        $client->loginUser($testUser);
        $server = [];
        $server["CONTENT_TYPE"] = "application/json";
        $content = '{
            "email": "email@email.com",
            "password": "abcd1234*"
        }';
        $client->request('POST', '/login',[],[],$server,$content);
        $this->assertResponseIsSuccessful();
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertIsArray($data);
        $this->assertArrayHasKey('message',$data);
        $this->assertEquals($data['message'],'success!');
    }

    public function testNoLoginWrongUser(): void
    {
        $client = static::createClient();
        $entityManager = static::getContainer()->get('doctrine')->getManager();
        $hasher = static::getContainer()->get(UserPasswordHasherInterface::class);
        $fixture = new AppFixtures($hasher);
        $fixture->load($entityManager);
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('email@email.com');
        $client->loginUser($testUser);
        $server = [];
        $server["CONTENT_TYPE"] = "application/json";
        $content = '{
            "email": "e@email.com",
            "password": "abcd1234*"
        }';
        $client->request('POST', '/login',[],[],$server,$content);
        $this->assertResponseStatusCodeSame(401);
    }
    
    public function testNoLoginWrongPass(): void
    {
        $client = static::createClient();
        $entityManager = static::getContainer()->get('doctrine')->getManager();
        $hasher = static::getContainer()->get(UserPasswordHasherInterface::class);
        $fixture = new AppFixtures($hasher);
        $fixture->load($entityManager);
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('email@email.com');
        $client->loginUser($testUser);
        $server = [];
        $server["CONTENT_TYPE"] = "application/json";
        $content = '{
            "email": "email@email.com",
            "password": "abcd1234"
        }';
        $client->request('POST', '/login',[],[],$server,$content);
        $this->assertResponseStatusCodeSame(401);
    }

}
