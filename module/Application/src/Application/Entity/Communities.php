<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Application\Entity\Communities
 *
 * @ORM\Entity(repositoryClass="CommunitiesRepository")
 * @ORM\Table(name="communities", indexes={@ORM\Index(name="countries_communities_fk", columns={"country_id"}), @ORM\Index(name="states_communities_fk", columns={"state_id"}), @ORM\Index(name="cities_communities_fk", columns={"city_id"})})
 */
class Communities
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Answers", mappedBy="communities")
     * @ORM\JoinColumn(name="community_id", referencedColumnName="id", nullable=false)
     */
    protected $answers;

    /**
     * @ORM\ManyToOne(targetEntity="Countries", inversedBy="communities")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="country_id")
     */
    protected $countries;

    /**
     * @ORM\ManyToOne(targetEntity="States", inversedBy="communities")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="state_id")
     */
    protected $states;

    /**
     * @ORM\ManyToOne(targetEntity="Cities", inversedBy="communities")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="city_id")
     */
    protected $cities;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Application\Entity\Communities
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return \Application\Entity\Communities
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
     * Add Answers entity to collection (one to many).
     *
     * @param \Application\Entity\Answers $answers
     * @return \Application\Entity\Communities
     */
    public function addAnswers(Answers $answers)
    {
        $this->answers[] = $answers;

        return $this;
    }

    /**
     * Get Answers entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Set Countries entity (many to one).
     *
     * @param \Application\Entity\Countries $countries
     * @return \Application\Entity\Communities
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

    /**
     * Set States entity (many to one).
     *
     * @param \Application\Entity\States $states
     * @return \Application\Entity\Communities
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

    /**
     * Set Cities entity (many to one).
     *
     * @param \Application\Entity\Cities $cities
     * @return \Application\Entity\Communities
     */
    public function setCities(Cities $cities = null)
    {
        $this->cities = $cities;

        return $this;
    }

    /**
     * Get Cities entity (many to one).
     *
     * @return \Application\Entity\Cities
     */
    public function getCities()
    {
        return $this->cities;
    }

    public function __sleep()
    {
        return array('id', 'name', 'country_id', 'state_id', 'city_id');
    }
}