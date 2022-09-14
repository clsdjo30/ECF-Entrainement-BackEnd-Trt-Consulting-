<?php

namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CandidateControllerTest extends WebTestCase
{
    public function testCandidatePageIsRestricted(): void
    {
        $client = static::createClient();
        $client->request('GET', '/candidate');

        self::assertResponseStatusCodeSame(Response::HTTP_FOUND);

    }
}
