<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Application\Entity\States
 *
 * @ORM\Entity(repositoryClass="StatesRepository")
 * @ORM\Table(name="states", indexes={@ORM\Index(name="countries_states_fk", columns={"country_id"})})
 */
class States
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $state_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Cities", mappedBy="states")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="state_id", nullable=false)
     */
    protected $cities;

    /**
     * @ORM\OneToMany(targetEntity="Communities", mappedBy="states")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="state_id")
     */
    protected $communities;

    /**
     * @ORM\ManyToOne(targetEntity="Countries", inversedBy="states")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="country_id", nullable=false)
     */
    protected $countries;

    public function __construct()
    {
        $this->cities = new ArrayCollection();
        $this->communities = new ArrayCollection();
    }

    /**
     * Set the value of state_id.
     *
     * @param integer $state_id
     * @return \Application\Entity\States
     */
    public function setStateId($state_id)
    {
        $this->state_id = $state_id;

        return $this;
    }

    /**
     * Get the value of state_id.
     *
     * @return integer
     */
    public function getStateId()
    {
        return $this->state_id;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return \Application\Entity\States
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
     * Add Cities entity to collection (one to many).
     *
     * @param \Application\Entity\Cities $cities
     * @return \Application\Entity\States
     */
    public function addCities(Cities $cities)
    {
        $this->cities[] = $cities;

        return $this;
    }

    /**
     * Get Cities entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * Add Communities entity to collection (one to many).
     *
     * @param \Application\Entity\Communities $communities
     * @return \Application\Entity\States
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
     * Set Countries entity (many to one).
     *
     * @param \Application\Entity\Countries $countries
     * @return \Application\Entity\States
     */
    public function setCountries(Countries $countries = null)
    {
        $this->countries = $countries;

        return $this;
    }

    /**
     * Get Countries entity (many to one).
     *
     * @return \Application\Entity\Countries
     */
    public function getCountries()
    {
        return $this->countries;
    }

    public function __sleep()
    {
        return array('state_id', 'country_id', 'name');
    }
}