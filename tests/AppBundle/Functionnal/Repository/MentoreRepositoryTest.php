<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 31/07/2016
 * Time: 19:03
 */

namespace tests\AppBundle\Functionnal\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MentoreRepositoryTest extends KernelTestCase
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

    public function testSearchByLastname()
    {
        $mentore = $this->em->getRepository('UserBundle:Mentore')
                            ->findOneBy(array('lastname' => 'Gaucher'));
        $this->assertCount(1, $mentore);
    }

    public function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null;
    }
}