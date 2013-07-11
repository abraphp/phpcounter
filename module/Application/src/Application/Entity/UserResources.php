<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Application\Entity\UserResources
 *
 * @ORM\Entity(repositoryClass="UserResourcesRepository")
 * @ORM\Table(name="user_resources")
 */
class UserResources
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $urid;

    /**
     * @ORM\Column(type="string", length=31)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=127)
     */
    protected $icon;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $base_url;

    /**
     * @ORM\OneToMany(targetEntity="Profiles", mappedBy="userResources")
     * @ORM\JoinColumn(name="urid", referencedColumnName="urid", nullable=false)
     */
    protected $profiles;

    public function __construct()
    {
        $this->profiles = new ArrayCollection();
    }

    /**
     * Set the value of urid.
     *
     * @param integer $urid
     * @return \Application\Entity\UserResources
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
     * Set the value of name.
     *
     * @param string $name
     * @return \Application\Entity\UserResources
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of icon.
     *
     * @param string $icon
     * @return \Application\Entity\UserResources
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get the value of icon.
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set the value of base_url.
     *
     * @param string $base_url
     * @return \Application\Entity\UserResources
     */
    public function setBaseUrl($base_url)
    {
        $this->base_url = $base_url;

        return $this;
    }

    /**
     * Get the value of base_url.
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->base_url;
    }

    /**
     * Add Profiles entity to collection (one to many).
     *
     * @param \Application\Entity\Profiles $profiles
     * @return \Application\Entity\UserResources
     */
    public function addProfiles(Profiles $profiles)
    {
        $this->profiles[] = $profiles;

        return $this;
    }

    /**
     * Get Profiles entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProfiles()
    {
        return $this->profiles;
    }

    public function __sleep()
    {
        return array('urid', 'name', 'icon', 'base_url');
    }
}