<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Application\Entity\AnswersCertifications
 *
 * @ORM\Entity(repositoryClass="AnswersCertificationsRepository")
 * @ORM\Table(name="answers_certifications", indexes={@ORM\Index(name="certifications_answers_certifications_fk", columns={"certification_id"}), @ORM\Index(name="answers_answers_certifications_fk", columns={"census_id", "user_id"})})
 */
class AnswersCertifications
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     */
    protected $user_id;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $census_id;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $certification_id;

    /**
     * @ORM\ManyToOne(targetEntity="Answers", inversedBy="answersCertifications")
     * @ORM\JoinColumn(name="census_id", referencedColumnName="census_id", nullable=false)
     */
    protected $answers;

    /**
     * @ORM\ManyToOne(targetEntity="Certifications", inversedBy="answersCertifications")
     * @ORM\JoinColumn(name="certification_id", referencedColumnName="id", nullable=false)
     */
    protected $certifications;

    public function __construct()
    {
    }

    /**
     * Set the value of user_id.
     *
     * @param integer $user_id
     * @return \Application\Entity\AnswersCertifications
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of user_id.
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set the value of census_id.
     *
     * @param integer $census_id
     * @return \Application\Entity\AnswersCertifications
     */
    public function setCensusId($census_id)
    {
        $this->census_id = $census_id;

        return $this;
    }

    /**
     * Get the value of census_id.
     *
     * @return integer
     */
    public function getCensusId()
    {
        return $this->census_id;
    }

    /**
     * Set the value of certification_id.
     *
     * @param integer $certification_id
     * @return \Application\Entity\AnswersCertifications
     */
    public function setCertificationId($certification_id)
    {
        $this->certification_id = $certification_id;

        return $this;
    }

    /**
     * Get the value of certification_id.
     *
     * @return integer
     */
    public function getCertificationId()
    {
        return $this->certification_id;
    }

    /**
     * Set Answers entity (many to one).
     *
     * @param \Application\Entity\Answers $answers
     * @return \Application\Entity\AnswersCertifications
     */
    public function setAnswers(Answers $answers = null)
    {
        $this->answers = $answers;

        return $this;
    }

    /**
     * Get Answers entity (many to one).
     *
     * @return \Application\Entity\Answers
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Set Certifications entity (many to one).
     *
     * @param \Application\Entity\Certifications $certifications
     * @return \Application\Entity\AnswersCertifications
     */
    public function setCertifications(Certifications $certifications = null)
    {
        $this->certifications = $certifications;

        return $this;
    }

    /**
     * Get Certifications entity (many to one).
     *
     * @return \Application\Entity\Certifications
     */
    public function getCertifications()
    {
        return $this->certifications;
    }

    public function __sleep()
    {
        return array('user_id', 'census_id', 'certification_id');
    }
}