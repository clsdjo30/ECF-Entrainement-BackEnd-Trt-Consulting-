<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SecurityControllerTest extends WebTestCase
{


    public function testConnexionPageIsFound(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');

        self::assertResponseIsSuccessful();
        self::assertResponseStatusCodeSame(Response::HTTP_OK);
        self::assertSelectorTextContains('h1', 'Connexion');
        self::assertSelectorNotExists('.alert.alert-danger');
    }

    public function testConnexionWithBadCredential(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('se connecter')->form([
            'email' => 'candidat@consulting.fr',
            'password' => 'fakepassword',
        ]);
        $client->submit($form);


        self::assertResponseRedirects('/login');

        $client->followRedirect();

        self::assertSelectorExists('.alert.alert-danger');
    }


}
