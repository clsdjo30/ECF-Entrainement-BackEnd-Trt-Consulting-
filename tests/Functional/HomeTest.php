<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeTest extends WebTestCase
{
    public function testShouldDisplayHomepage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $client->followRedirects();

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'pour vous servir');


    }
}
