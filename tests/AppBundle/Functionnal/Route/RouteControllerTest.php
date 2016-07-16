<?php

namespace Tests\AppBundle\Functionnal\Route;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RouteControllerTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    /**
     * @return array
     *
     * Provide the different routes through the application
     */
    public function urlProvider()
    {
        return array(
            array('/'),
            array('/login'),
            array('/login_check'),
            array('backend/'),
            array('/backend/list/mentors'),
            array('/backend/list/mentore'),
            array('/backend/list/soutenances'),
            array('/dashboard'),
            array('/dashboard/infos'),
            array('/dashboard/mes-mentores/en-cours'),
            array('/dashboard/mes-mentores/en-attente'),
            array('/dashboard/mes-mentores/mentorat-termine')
        );
    }
}
