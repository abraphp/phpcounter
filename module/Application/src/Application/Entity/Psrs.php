<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Application\Entity\Psrs
 *
 * @ORM\Entity(repositoryClass="PsrsRepository")
 * @ORM\Table(name="psrs", uniqueConstraints={@ORM\UniqueConstraint(name="uq_psrs_identifier", columns={"identifier"})})
 */
class Psrs
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=7)
     */
    protected $identifier;

    /**
     * @ORM\OneToMany(targetEntity="Answers", mappedBy="psrs")
     * @ORM\JoinColumn(name="psr_id", referencedColumnName="id", nullable=false)
     */
    protected $answers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Application\Entity\Psrs
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
     * Set the value of identifier.
     *
     * @param string $identifier
     * @return \Application\Entity\Psrs
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
     * Add Answers entity to collection (one to many).
     *
     * @param \Application\Entity\Answers $answers
     * @return \Application\Entity\Psrs
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

    public function __sleep()
    {
        return array('id', 'identifier');
    }
}