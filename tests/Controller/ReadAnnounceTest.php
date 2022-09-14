<?php


namespace App\Tests\Controller;

use App\Entity\Announce;
use Doctrine\ORM\EntityManagerInterface;
use Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ReadAnnounceTest
 * @package App\Tests\Controller
 */
class ReadAnnounceTest extends WebTestCase
{
    /**
     * @dataProvider provideUri
     * @param string $uri
     */
    public function test(string $uri)
    {
        $client = static::createClient();

        /**@var UrlGeneratorInterface $urlGenerator */
        $urlGenerator = $client->getContainer()->get('router.default');

        /**@var EntityManagerInterface $entityManager */
        $entityManager = $client->getContainer()->get("doctrine.orm.entity_manager");

        /**@var Announce $announce */
        $announce = $entityManager->getRepository(Announce::class)->findOneBy([]);

        $client->request(
            Request::METHOD_GET,
            $urlGenerator->generate('app_announce_details', ['id' => $announce->getId()])
        );

        self::assertResponseRedirects('/login');


    }

    /**
     * @return Generator
     */
    public function provideUri(): Generator
    {
        yield ['/announce/{id}'];
        yield ['/announce/{id}'];
    }

}