<?php

namespace App\Tests\Repository;

use App\Entity\User;
use App\Repository\UserRepository;
use stdClass;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class UserRepositoryTest extends KernelTestCase
{
    private $userRepository;
    private $passwordHasher;

    private function initialize()
    {
        self::bootKernel();
        $this->userRepository = static::getContainer()->get(UserRepository::class);
        $this->passwordHasher = static::getContainer()->get(UserPasswordHasherInterface::class);
    }

    private function hashPassword(User $user) : User
    {
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $user->getPassword()
        );
        $user->setPassword($hashedPassword);
        return $user;
    }

    public function testSaveUser()
    {
        $this->initialize();
        $email = 'email@email.com';
        $password = 'abcd1234*';
        $user = new User ($email,$password);
        $user = $this->hashPassword($user);
        $user = $user = $this->userRepository->saveUser($user);
        $userFromRepo  = $this->userRepository->findOneByEmail($email);
        $this->assertNotNull($user->getId());
        $this->assertEquals($user->getId(), $userFromRepo->getId());
        $this->assertEquals($user->getPassword(), $userFromRepo->getPassword());
        return $user;
    }

    /**
     * @depends testSaveUser
     */
    public function testUpgradePassword(User $user)
    {
        $this->initialize();
        $oldPassword = $user->getPassword();
        $newPassword = '12345678';
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $newPassword
        );
        $user = $this->userRepository->upgradePassword($user,$hashedPassword);
        $userFromRepo  = $this->userRepository->findOneByEmail($user->getEmail());
        $this->assertEquals($hashedPassword, $userFromRepo->getPassword());
        $this->assertNotEquals($user->getPassword(),$oldPassword);
    }

    public function testBreakUpgradePassword()
    {
        $this->initialize();
        $user = new stdClass();
        $hashedPassword = "";
        $this->expectException(\TypeError::class);
        $user = $this->userRepository->upgradePassword($user,$hashedPassword);
    }
}