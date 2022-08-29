<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeTest extends WebTestCase
{
    public function testShouldDisplayHomepage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');


        self::assertPageTitleSame('TrT Consulting - Home Page');


    }

    public function test404(): void
    {
        $client = self::createClient();
        $client->request('GET', '/404');
        self::assertTrue($client->getResponse()->isNotFound());
    }
}
