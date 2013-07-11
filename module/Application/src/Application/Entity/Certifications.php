<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Application\Entity\Certifications
 *
 * @ORM\Entity(repositoryClass="CertificationsRepository")
 * @ORM\Table(name="certifications", uniqueConstraints={@ORM\UniqueConstraint(name="uq_certifications_name", columns={"name"})})
 */
class Certifications
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=23)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="AnswersCertifications", mappedBy="certifications")
     * @ORM\JoinColumn(name="certification_id", referencedColumnName="id", nullable=false)
     */
    protected $answersCertifications;

    public function __construct()
    {
        $this->answersCertifications = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Application\Entity\Certifications
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
     * @return \Application\Entity\Certifications
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
     * Add AnswersCertifications entity to collection (one to many).
     *
     * @param \Application\Entity\AnswersCertifications $answersCertifications
     * @return \Application\Entity\Certifications
     */
    public function addAnswersCertifications(AnswersCertifications $answersCertifications)
    {
        $this->answersCertifications[] = $answersCertifications;

        return $this;
    }

    /**
     * Get AnswersCertifications entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnswersCertifications()
    {
        return $this->answersCertifications;
    }

    public function __sleep()
    {
        return array('id', 'name');
    }
}