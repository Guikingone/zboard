<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\AppBundle\Functionnal\Repository\BackendBundle;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CoursRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()->get('doctrine')->getManager();
    }

    public function testSearchByLibelle()
    {
        return $this->em->getRepository('BackendBundle:Cours')
                        ->findOneBy(array('libelle' => 'Comprendre le web'));
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null;
    }
}