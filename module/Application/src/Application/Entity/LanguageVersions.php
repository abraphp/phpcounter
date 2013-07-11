<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Application\Entity\LanguageVersions
 *
 * @ORM\Entity(repositoryClass="LanguageVersionsRepository")
 * @ORM\Table(name="language_versions", uniqueConstraints={@ORM\UniqueConstraint(name="uq_language_versions_version", columns={"version"})})
 */
class LanguageVersions
{
    /**
     * @ORM\Id
     * @ORM\Column(type="smallint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=8)
     */
    protected $version;

    /**
     * @ORM\OneToMany(targetEntity="Answers", mappedBy="languageVersions")
     * @ORM\JoinColumn(name="language_version_id", referencedColumnName="id", nullable=false)
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
     * @return \Application\Entity\LanguageVersions
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
     * Set the value of version.
     *
     * @param string $version
     * @return \Application\Entity\LanguageVersions
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get the value of version.
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Add Answers entity to collection (one to many).
     *
     * @param \Application\Entity\Answers $answers
     * @return \Application\Entity\LanguageVersions
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
        return array('id', 'version');
    }
}