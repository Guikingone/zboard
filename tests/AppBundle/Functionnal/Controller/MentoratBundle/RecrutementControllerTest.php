<?php

namespace tests\AppBundle\Functionnal\Controller\AdminBundle;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RecrutementControllerTest extends WebTestCase
{
    public function testCandidature()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/candidatures');
    }

    public function testFormation()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/formations');
    }
}
