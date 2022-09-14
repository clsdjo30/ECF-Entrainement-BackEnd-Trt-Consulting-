<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeTest extends WebTestCase
{
    public function testHomePageTitle(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');


        self::assertSelectorTextContains('h1', 'pour vous servir');
    }

    public function testVerificationEmail(): void
    {
        $client = static::createClient();
        $client->request('GET', '/verification');


        self::assertSelectorTextContains('h1', 'Confirmer votre adresse email');
    }

    public function testPendingValidation(): void
    {
        $client = static::createClient();
        $client->request('GET', '/first-connexion');


        self::assertSelectorTextContains('h1', 'Pour accéder à nos services, rendez-vous sur votre compte');
    }
}
