<?php
namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    public function testSettingUserEmail()
    {
        $user = new User();
        $email = "email@email.com";
        $user->setEmail($email);
        $this->assertEquals($user->getEmail(), $email);
    }

    public function testSettingUserPassword()
    {
        $user = new User();
        $password = "password@password.com";
        $user->setPassword($password);
        $this->assertEquals($user->getPassword(), $password);
    }

    public function testGettingUserIdentifier()
    {
        $user = new User();
        $email = "password@password.com";
        $user->setEmail($email);
        $this->assertEquals($user->getUserIdentifier(), $email);
    }

    public function testGettingUserName()
    {
        $user = new User();
        $email = "password@password.com";
        $user->setEmail($email);
        $this->assertEquals($user->getUserName(), $email);
    }

    public function testDefaultRoles()
    {
        $user = new User();
        $this->assertContains('ROLE_USER',$user->getRoles());
    }

    public function testAddRole()
    {
        $user = new User();
        $user->setRoles(['ROLE_ADMIN']);
        $this->assertContains('ROLE_ADMIN',$user->getRoles());
        $this->assertContains('ROLE_USER',$user->getRoles());
    }

    public function testUserParametricConstructor()
    {
        $credentials = [];
        $credentials["email"] = "email@email.com";
        $credentials["password"] = "abcd1234*";
        $user = new User($credentials["email"],$credentials["password"]);
        $results = [];
        $results["email"] = $user->getEmail();
        $results["password"] = $user->getPassword();
        $this->assertEquals($credentials,$results);
    }

}
