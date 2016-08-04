<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\AppBundle\Functionnal\Route;

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
            array('/join'),
            array('/login'),
            array('/login_check'),
            array('/register/'),
            array('/register/check-email'),
            array('/register/confirm/2457037300168'),
            array('/register/confirmed'),
            array('/resetting/request'),
            array('/resetting/send-email'),
            array('/resetting/check-email'),
            array('/resetting/reset/24566721324778'),
            array('/logout'),
            array('/profile/'),
            array('/profile/edit'),
            array('/profile/change-password'),
            array('/group/list'),
            array('/group/new'),
            array('/group/mentor'),
            array('/group/mentor/edit'),
            array('/group/mentor/delete'),
            array('/backend/'),
            array('/backend/list/mentors'),
            array('/backend/list/mentore'),
            array('/backend/list/soutenances'),
            array('/backend/list/parcours'),
            array('/backend/show/path/1/details'),
            array('/backend/utils/1/mentors'),
            array('/backend/utils/1/mentores'),
            array('/backend/utils/1/path'),
            array('/backend/utils/1/courses'),
            array('/backend/utils/1/project'),
            array('/backend/utils/1/competence'),
            array('/backend/utils/1/soutenance'),
            array('/backend/archived/mentor/1'),
            array('/backend/archived/mentore/1'),
            array('/backend/archived/path/1'),
            array('/admin3744/'),
            array('/admin3744/archives'),
            array('/admin3744/archived/out/mentor/1'),
            array('/admin3744/archived/out/mentore/1'),
            array('/admin3744/archived/out/path/1'),
            array('/admin3744/users/list'),
            array('/admin3744/users/update/roles/users/1'),
            array('/admin3744/users/update/roles/mentores/1'),
            array('/admin3744/country'),
            array('/admin3744/habilitations'),
            array('/admin3744/show/abonnements'),
            array('/notifications'),
            array('/dashboard'),
            array('/dashboard/infos'),
            array('/dashboard/mes-mentores/en-cours'),
            array('/dashboard/mes-mentores/en-attente'),
            array('/dashboard/mes-mentores/mentorat-termine'),
            array('/dashboard/show/1/mentore/details'),
            array('/dashboard/show/1/mentor/details'),
            array('dashboard/mes-soutenances/en-attente'),
            array('/dashboard/mes-soutenances/effectuees'),
            array('/dashboard/tutoriels'),
            array('/dashboard/utils/1/courses/update'),
            array('/dashboard/utils/1/project/update'),
        );
    }
}
