<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Application\Entity\VersioningSystems
 *
 * @ORM\Entity(repositoryClass="VersioningSystemsRepository")
 * @ORM\Table(name="versioning_systems", uniqueConstraints={@ORM\UniqueConstraint(name="uq_versioning_systems_name", columns={"name"})})
 */
class VersioningSystems
{
    /**
     * @ORM\Id
     * @ORM\Column(type="smallint")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=63)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Answers", mappedBy="versioningSystems")
     * @ORM\JoinColumn(name="versioning_system_id", referencedColumnName="id", nullable=false)
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
     * @return \Application\Entity\VersioningSystems
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
     * @return \Application\Entity\VersioningSystems
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
     * @return \Application\Entity\VersioningSystems
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