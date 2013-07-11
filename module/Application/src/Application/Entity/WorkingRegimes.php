<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Application\Entity\WorkingRegimes
 *
 * @ORM\Entity(repositoryClass="WorkingRegimesRepository")
 * @ORM\Table(name="working_regimes", uniqueConstraints={@ORM\UniqueConstraint(name="uq_working_regimes_name", columns={"name"})})
 */
class WorkingRegimes
{
    /**
     * @ORM\Id
     * @ORM\Column(type="smallint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=127)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="SensitiveAnswers", mappedBy="workingRegimes")
     * @ORM\JoinColumn(name="working_regime_id", referencedColumnName="id", nullable=false)
     */
    protected $sensitiveAnswers;

    public function __construct()
    {
        $this->sensitiveAnswers = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Application\Entity\WorkingRegimes
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
     * @return \Application\Entity\WorkingRegimes
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
     * Add SensitiveAnswers entity to collection (one to many).
     *
     * @param \Application\Entity\SensitiveAnswers $sensitiveAnswers
     * @return \Application\Entity\WorkingRegimes
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
        return array('id', 'name');
    }
}