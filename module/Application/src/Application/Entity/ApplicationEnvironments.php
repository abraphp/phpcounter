<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Application\Entity\ApplicationEnvironments
 *
 * @ORM\Entity(repositoryClass="ApplicationEnvironmentsRepository")
 * @ORM\Table(name="application_environments", uniqueConstraints={@ORM\UniqueConstraint(name="uq_application_types_name", columns={"name"})})
 */
class ApplicationEnvironments
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=123)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Answers", mappedBy="applicationEnvironments")
     * @ORM\JoinColumn(name="application_environment_id", referencedColumnName="id", nullable=false)
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
     * @return \Application\Entity\ApplicationEnvironments
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
     * @return \Application\Entity\ApplicationEnvironments
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
     * @return \Application\Entity\ApplicationEnvironments
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
        return array('id', 'name');
    }
}