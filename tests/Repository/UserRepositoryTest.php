<?php

namespace App\Tests\Repository;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class UserRepositoryTest extends KernelTestCase
{
    public function testSaveUser()
    {
        self::bootKernel();
        $container = static::getContainer();
        $passwordHasher = $container->get(UserPasswordHasherInterface::class);
        $userRepository = $container->get(UserRepository::class);
        $email = 'email@email.com';
        $password = 'abcd1234*';
        $user = new User ($email,$password);
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $user->getPassword()
        );
        $user->setPassword($hashedPassword);
        $user = $user = $userRepository->saveUser($user);
        $userFromRepo  = $userRepository->findOneByEmail($email);
        $this->assertEquals($user->getId(), $userFromRepo->getId());
        $this->assertEquals($hashedPassword, $userFromRepo->getPassword());
    }
}