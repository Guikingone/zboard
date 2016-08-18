<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * UserGroup.
 *
 * @ORM\Table(name="zboard_group_user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserGroupRepository")
 */
class UserGroup extends BaseGroup
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
