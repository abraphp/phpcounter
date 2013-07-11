<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Application\Entity\Countries
 *
 * @ORM\Entity(repositoryClass="CountriesRepository")
 * @ORM\Table(name="countries", uniqueConstraints={@ORM\UniqueConstraint(name="uq_country_name", columns={"name"}), @ORM\UniqueConstraint(name="uq_countries_iso3166", columns={"iso3166"})})
 */
class Countries
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $country_id;

    /**
     * @ORM\Column(type="string", length=127)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=3)
     */
    protected $iso3166;

    /**
     * @ORM\OneToMany(targetEntity="Communities", mappedBy="countries")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="country_id")
     */
    protected $communities;

    /**
     * @ORM\OneToMany(targetEntity="States", mappedBy="countries")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="country_id", nullable=false)
     */
    protected $states;

    public function __construct()
    {
        $this->communities = new ArrayCollection();
        $this->states = new ArrayCollection();
    }

    /**
     * Set the value of country_id.
     *
     * @param integer $country_id
     * @return \Application\Entity\Countries
     */
    public function setCountryId($country_id)
    {
        $this->country_id = $country_id;

        return $this;
    }

    /**
     * Get the value of country_id.
     *
     * @return integer
     */
    public function getCountryId()
    {
        return $this->country_id;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return \Application\Entity\Countries
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
     * Set the value of iso3166.
     *
     * @param string $iso3166
     * @return \Application\Entity\Countries
     */
    public function setIso3166($iso3166)
    {
        $this->iso3166 = $iso3166;

        return $this;
    }

    /**
     * Get the value of iso3166.
     *
     * @return string
     */
    public function getIso3166()
    {
        return $this->iso3166;
    }

    /**
     * Add Communities entity to collection (one to many).
     *
     * @param \Application\Entity\Communities $communities
     * @return \Application\Entity\Countries
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
     * Add States entity to collection (one to many).
     *
     * @param \Application\Entity\States $states
     * @return \Application\Entity\Countries
     */
    public function addStates(States $states)
    {
        $this->states[] = $states;

        return $this;
    }

    /**
     * Get States entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStates()
    {
        return $this->states;
    }

    public function __sleep()
    {
        return array('country_id', 'name', 'iso3166');
    }
}