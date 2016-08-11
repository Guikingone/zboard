<?php

namespace tests\AppBundle\Functionnal\Controller\MentoratBundle;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FormationControllerTest extends WebTestCase
{
    public function testCandidature()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/formation');
    }
}
