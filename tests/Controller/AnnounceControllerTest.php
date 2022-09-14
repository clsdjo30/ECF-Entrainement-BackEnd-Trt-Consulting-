<?php

namespace App\Tests\Controller;

use Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AnnounceControllerTest extends WebTestCase
{
    /**
     * @dataProvider provideUri
     * @param string $uri
     */
    public function testAnnounceShow(string $uri): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $uri);

        self::assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    /**
     * @return Generator
     */
    public function provideUri(): Generator
    {
        yield ['/'];
        yield ['/?page=2'];
    }


}
