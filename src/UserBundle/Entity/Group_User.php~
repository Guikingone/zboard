<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * Group_User.
 *
 * @ORM\Table(name="zboard_group_user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\Group_UserRepository")
 */
class Group_User extends BaseGroup
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
