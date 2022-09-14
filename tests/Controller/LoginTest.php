<?php

namespace App\Tests\Controller;

use App\Repository\AnnounceRepository;
use App\Repository\UserRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 *Class LoginTest
 * @package App\Tests\Controller
 */
class LoginTest extends WebTestCase
{


    /**
     * @throws Exception
     */
    public function testCandidateLogin()
    {
        $client = static::createClient();

        $client->request(Request::METHOD_GET, '/login');

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'candidate@trt-consulting.com']);

        $client->loginUser($testUser);

        self::assertResponseStatusCodeSame(Response::HTTP_OK);


    }

    /**
     * @throws Exception
     */
    public function testCountAnnounce()
    {
        $client = static::createClient();

        $client->request(Request::METHOD_GET, '/announce');

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'candidate@trt-consulting.com']);

        $announceRepository = static::getContainer()->get(AnnounceRepository::class);
        $announceRepository->findAll();


        $client->loginUser($testUser);

        self::assertResponseStatusCodeSame(Response::HTTP_MOVED_PERMANENTLY);


    }

    /**
     * @throws Exception
     */
    public function testCandidateDetails()
    {
        $client = static::createClient();


        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'candidate@trt-consulting.com']);

        $client->loginUser($testUser);

        $client->request(Request::METHOD_GET, '/candidate/{id}');

        self::assertResponseStatusCodeSame(Response::HTTP_OK);

        self::assertPageTitleContains('Mes Informations');

    }

    /**
     * @throws Exception
     */
    public function testCandidateNeedLogin()
    {
        $client = static::createClient();


        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'candidate@trt-consulting.com']);

        $client->loginUser($testUser);

        $client->request(Request::METHOD_GET, '/candidate/{id}');

        self::assertResponseStatusCodeSame(Response::HTTP_OK);

        self::assertPageTitleContains('Mes Informations');

    }


}