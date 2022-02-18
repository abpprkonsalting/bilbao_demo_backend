<?php

namespace App\Tests\Security;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Security\Core\Authentication\Token\NullToken;
use Firebase\JWT\JWT;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;;

use App\Security\ApiKeyAuthenticator;

class ApiKeyAuthenticatorTest extends KernelTestCase 
{
    private $authenticator;
    private $params;

    private function initialize() {
        self::bootKernel();
        $this->authenticator = static::getContainer()->get(ApiKeyAuthenticator::class);
        $this->params = static::getContainer()->get(ContainerBagInterface::class);
    }

    public function testAuthenticate() 
    {
        $this->initialize();
        $email = 'email@email.com';
        $payload = [
            "user" => $email,
            "expire"  => (new \DateTime())->modify("+5 minutes")->getTimestamp(),
        ];
        $jwt = JWT::encode($payload, $this->params->get('jwt_secret'), 'HS256');
        $request = new Request();
        $request->headers = new HeaderBag(['X-AUTH-TOKEN' => $jwt]);
        $passport = $this->authenticator->authenticate($request);
        $badges= $passport->getBadges();
        $this->assertCount(1,$badges);
        $badge = array_pop($badges);
        $this->assertEquals($email,$badge->getUserIdentifier());
    }

    public function testNoTokenAuthenticate() 
    {
        $this->initialize();
        $email = 'email@email.com';
        $payload = [
            "user" => $email,
            "expire"  => (new \DateTime())->modify("+5 minutes")->getTimestamp(),
        ];
        $jwt = JWT::encode($payload, $this->params->get('jwt_secret'), 'HS256');
        $request = new Request();
        //$request->headers = new HeaderBag(['X-AUTH-TOKEN' => $jwt]);
        $this->expectException(CustomUserMessageAuthenticationException::class);
        $passport = $this->authenticator->authenticate($request);
    }

    public function testOnAuthenticationSuccess()
    {
        $this->initialize();
        $this->assertNull($this->authenticator->onAuthenticationSuccess(
                                                new Request(),
                                                new NullToken(),
                                                ''));
    }

    public function testOnAuthenticationFailure()
    {
        $this->initialize();
        $exception = new AuthenticationException("message");
        $response = $this->authenticator->onAuthenticationFailure(
                                                new Request(),
                                                $exception);
        $expected = new JsonResponse([
                                        'message' => strtr($exception->getMessageKey(), 
                                                            $exception->getMessageData())],
                                        Response::HTTP_UNAUTHORIZED);
        $this->assertEquals($response,$expected);
    }
}