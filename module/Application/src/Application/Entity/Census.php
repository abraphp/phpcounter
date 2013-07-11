<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Application\Entity\Census
 *
 * @ORM\Entity(repositoryClass="CensusRepository")
 * @ORM\Table(name="census", uniqueConstraints={@ORM\UniqueConstraint(name="uq_census_year", columns={"year"})})
 */
class Census
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="smallint")
     */
    protected $year;

    /**
     * @ORM\OneToMany(targetEntity="Answers", mappedBy="census")
     * @ORM\JoinColumn(name="census_id", referencedColumnName="id", nullable=false)
     */
    protected $answers;

    /**
     * @ORM\OneToMany(targetEntity="SensitiveAnswers", mappedBy="census")
     * @ORM\JoinColumn(name="census_id", referencedColumnName="id", nullable=false)
     */
    protected $sensitiveAnswers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->sensitiveAnswers = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Application\Entity\Census
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
     * Set the value of year.
     *
     * @param integer $year
     * @return \Application\Entity\Census
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get the value of year.
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Add Answers entity to collection (one to many).
     *
     * @param \Application\Entity\Answers $answers
     * @return \Application\Entity\Census
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
     * Add SensitiveAnswers entity to collection (one to many).
     *
     * @param \Application\Entity\SensitiveAnswers $sensitiveAnswers
     * @return \Application\Entity\Census
     */
    public function addSensitiveAnswers(SensitiveAnswers $sensitiveAnswers)
    {
        $this->sensitiveAnswers[] = $sensitiveAnswers;

        return $this;
    }

    /**
     * Get SensitiveAnswers entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSensitiveAnswers()
    {
        return $this->sensitiveAnswers;
    }

    public function __sleep()
    {
        return array('id', 'year');
    }
}