<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Application\Entity\Cities
 *
 * @ORM\Entity(repositoryClass="CitiesRepository")
 * @ORM\Table(name="cities", indexes={@ORM\Index(name="states_cities_fk", columns={"state_id"})})
 */
class Cities
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $city_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Communities", mappedBy="cities")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="city_id")
     */
    protected $communities;

    /**
     * @ORM\OneToMany(targetEntity="Users", mappedBy="cities")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="city_id", nullable=false)
     */
    protected $users;

    /**
     * @ORM\ManyToOne(targetEntity="States", inversedBy="cities")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="state_id", nullable=false)
     */
    protected $states;

    public function __construct()
    {
        $this->communities = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    /**
     * Set the value of city_id.
     *
     * @param integer $city_id
     * @return \Application\Entity\Cities
     */
    public function setCityId($city_id)
    {
        $this->city_id = $city_id;

        return $this;
    }

    /**
     * Get the value of city_id.
     *
     * @return integer
     */
    public function getCityId()
    {
        return $this->city_id;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return \Application\Entity\Cities
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
     * Add Communities entity to collection (one to many).
     *
     * @param \Application\Entity\Communities $communities
     * @return \Application\Entity\Cities
     */
    public function addCommunities(Communities $communities)
    {
        $this->communities[] = $communities;

        return $this;
    }

    /**
     * Get Communities entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommunities()
    {
        return $this->communities;
    }

    /**
     * Add Users entity to collection (one to many).
     *
     * @param \Application\Entity\Users $users
     * @return \Application\Entity\Cities
     */
    public function addUsers(Users $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Get Users entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set States entity (many to one).
     *
     * @param \Application\Entity\States $states
     * @return \Application\Entity\Cities
     */
    public function setStates(States $states = null)
    {
        $this->states = $states;

        return $this;
    }

    /**
     * Get States entity (many to one).
     *
     * @return \Application\Entity\States
     */
    public function getStates()
    {
        return $this->states;
    }

    public function __sleep()
    {
        return array('city_id', 'state_id', 'name');
    }
}