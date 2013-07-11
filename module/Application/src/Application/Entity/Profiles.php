<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Application\Entity\Profiles
 *
 * @ORM\Entity(repositoryClass="ProfilesRepository")
 * @ORM\Table(name="profiles", indexes={@ORM\Index(name="user_resources_profiles_fk", columns={"urid"})})
 */
class Profiles
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     */
    protected $user_id;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $urid;

    /**
     * @ORM\Column(type="string", length=127)
     */
    protected $identifier;

    /**
     * @ORM\ManyToOne(targetEntity="Users", inversedBy="profiles")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $users;

    /**
     * @ORM\ManyToOne(targetEntity="UserResources", inversedBy="profiles")
     * @ORM\JoinColumn(name="urid", referencedColumnName="urid", nullable=false)
     */
    protected $userResources;

    public function __construct()
    {
    }

    /**
     * Set the value of user_id.
     *
     * @param integer $user_id
     * @return \Application\Entity\Profiles
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of user_id.
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set the value of urid.
     *
     * @param integer $urid
     * @return \Application\Entity\Profiles
     */
    public function setUrid($urid)
    {
        $this->urid = $urid;

        return $this;
    }

    /**
     * Get the value of urid.
     *
     * @return integer
     */
    public function getUrid()
    {
        return $this->urid;
    }

    /**
     * Set the value of identifier.
     *
     * @param string $identifier
     * @return \Application\Entity\Profiles
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Get the value of identifier.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set Users entity (many to one).
     *
     * @param \Application\Entity\Users $users
     * @return \Application\Entity\Profiles
     */
    public function setUsers(Users $users = null)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get Users entity (many to one).
     *
     * @return \Application\Entity\Users
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set UserResources entity (many to one).
     *
     * @param \Application\Entity\UserResources $userResources
     * @return \Application\Entity\Profiles
     */
    public function setUserResources(UserResources $userResources = null)
    {
        $this->userResources = $userResources;

        return $this;
    }

    /**
     * Get UserResources entity (many to one).
     *
     * @return \Application\Entity\UserResources
     */
    public function getUserResources()
    {
        return $this->userResources;
    }

    public function __sleep()
    {
        return array('user_id', 'urid', 'identifier');
    }
}