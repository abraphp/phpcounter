<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Application\Entity\Answers
 *
 * @ORM\Entity(repositoryClass="AnswersRepository")
 * @ORM\Table(name="answers", indexes={@ORM\Index(name="psrs_answers_fk", columns={"psr_id"}), @ORM\Index(name="application_types_answers_fk", columns={"application_environment_id"}), @ORM\Index(name="census_answers_fk", columns={"census_id"}), @ORM\Index(name="versioning_systems_answers_fk", columns={"versioning_system_id"}), @ORM\Index(name="webservers_answers_fk", columns={"webserver_id"}), @ORM\Index(name="databases_answers_fk", columns={"database_id"}), @ORM\Index(name="ides_answers_fk", columns={"editor_id"}), @ORM\Index(name="operating_systems_answers_fk", columns={"operating_system_id"}), @ORM\Index(name="frameworks_answers_fk", columns={"framework_id"}), @ORM\Index(name="language_versions_answers_fk", columns={"language_version_id"}), @ORM\Index(name="communities_answers_fk", columns={"community_id"})})
 */
class Answers
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
     * @ORM\ManyToOne(targetEntity="Users", inversedBy="answers")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $users;

    /**
     * @ORM\OneToMany(targetEntity="AnswersCertifications", mappedBy="answers")
     * @ORM\JoinColumn(name="census_id", referencedColumnName="census_id", nullable=false)
     */
    protected $answersCertifications;

    /**
     * @ORM\ManyToOne(targetEntity="Census", inversedBy="answers")
     * @ORM\JoinColumn(name="census_id", referencedColumnName="id", nullable=false)
     */
    protected $census;

    /**
     * @ORM\ManyToOne(targetEntity="OperatingSystems", inversedBy="answers")
     * @ORM\JoinColumn(name="operating_system_id", referencedColumnName="id", nullable=false)
     */
    protected $operatingSystems;

    /**
     * @ORM\ManyToOne(targetEntity="Frameworks", inversedBy="answers")
     * @ORM\JoinColumn(name="framework_id", referencedColumnName="id")
     */
    protected $frameworks;

    /**
     * @ORM\ManyToOne(targetEntity="LanguageVersions", inversedBy="answers")
     * @ORM\JoinColumn(name="language_version_id", referencedColumnName="id", nullable=false)
     */
    protected $languageVersions;

    /**
     * @ORM\ManyToOne(targetEntity="Editors", inversedBy="answers")
     * @ORM\JoinColumn(name="editor_id", referencedColumnName="id", nullable=false)
     */
    protected $editors;

    /**
     * @ORM\ManyToOne(targetEntity="Databases1", inversedBy="answers")
     * @ORM\JoinColumn(name="database_id", referencedColumnName="id")
     */
    protected $databases1;

    /**
     * @ORM\ManyToOne(targetEntity="Communities", inversedBy="answers")
     * @ORM\JoinColumn(name="community_id", referencedColumnName="id", nullable=false)
     */
    protected $communities;

    /**
     * @ORM\ManyToOne(targetEntity="Webservers", inversedBy="answers")
     * @ORM\JoinColumn(name="webserver_id", referencedColumnName="id", nullable=false)
     */
    protected $webservers;

    /**
     * @ORM\ManyToOne(targetEntity="VersioningSystems", inversedBy="answers")
     * @ORM\JoinColumn(name="versioning_system_id", referencedColumnName="id", nullable=false)
     */
    protected $versioningSystems;

    /**
     * @ORM\ManyToOne(targetEntity="ApplicationEnvironments", inversedBy="answers")
     * @ORM\JoinColumn(name="application_environment_id", referencedColumnName="id", nullable=false)
     */
    protected $applicationEnvironments;

    /**
     * @ORM\ManyToOne(targetEntity="Psrs", inversedBy="answers")
     * @ORM\JoinColumn(name="psr_id", referencedColumnName="id", nullable=false)
     */
    protected $psrs;

    public function __construct()
    {
        $this->answersCertifications = new ArrayCollection();
    }

    /**
     * Set the value of user_id.
     *
     * @param integer $user_id
     * @return \Application\Entity\Answers
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
     * @return \Application\Entity\Answers
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
     * Set Users entity (many to one).
     *
     * @param \Application\Entity\Users $users
     * @return \Application\Entity\Answers
     */
    public function setUsers(Users $users = null)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get Users entity (many to one).
     *
     * @return \Application\Entity\Users
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add AnswersCertifications entity to collection (one to many).
     *
     * @param \Application\Entity\AnswersCertifications $answersCertifications
     * @return \Application\Entity\Answers
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

    /**
     * Set Census entity (many to one).
     *
     * @param \Application\Entity\Census $census
     * @return \Application\Entity\Answers
     */
    public function setCensus(Census $census = null)
    {
        $this->census = $census;

        return $this;
    }

    /**
     * Get Census entity (many to one).
     *
     * @return \Application\Entity\Census
     */
    public function getCensus()
    {
        return $this->census;
    }

    /**
     * Set OperatingSystems entity (many to one).
     *
     * @param \Application\Entity\OperatingSystems $operatingSystems
     * @return \Application\Entity\Answers
     */
    public function setOperatingSystems(OperatingSystems $operatingSystems = null)
    {
        $this->operatingSystems = $operatingSystems;

        return $this;
    }

    /**
     * Get OperatingSystems entity (many to one).
     *
     * @return \Application\Entity\OperatingSystems
     */
    public function getOperatingSystems()
    {
        return $this->operatingSystems;
    }

    /**
     * Set Frameworks entity (many to one).
     *
     * @param \Application\Entity\Frameworks $frameworks
     * @return \Application\Entity\Answers
     */
    public function setFrameworks(Frameworks $frameworks = null)
    {
        $this->frameworks = $frameworks;

        return $this;
    }

    /**
     * Get Frameworks entity (many to one).
     *
     * @return \Application\Entity\Frameworks
     */
    public function getFrameworks()
    {
        return $this->frameworks;
    }

    /**
     * Set LanguageVersions entity (many to one).
     *
     * @param \Application\Entity\LanguageVersions $languageVersions
     * @return \Application\Entity\Answers
     */
    public function setLanguageVersions(LanguageVersions $languageVersions = null)
    {
        $this->languageVersions = $languageVersions;

        return $this;
    }

    /**
     * Get LanguageVersions entity (many to one).
     *
     * @return \Application\Entity\LanguageVersions
     */
    public function getLanguageVersions()
    {
        return $this->languageVersions;
    }

    /**
     * Set Editors entity (many to one).
     *
     * @param \Application\Entity\Editors $editors
     * @return \Application\Entity\Answers
     */
    public function setEditors(Editors $editors = null)
    {
        $this->editors = $editors;

        return $this;
    }

    /**
     * Get Editors entity (many to one).
     *
     * @return \Application\Entity\Editors
     */
    public function getEditors()
    {
        return $this->editors;
    }

    /**
     * Set Databases1 entity (many to one).
     *
     * @param \Application\Entity\Databases1 $databases1
     * @return \Application\Entity\Answers
     */
    public function setDatabases1(Databases1 $databases1 = null)
    {
        $this->databases1 = $databases1;

        return $this;
    }

    /**
     * Get Databases1 entity (many to one).
     *
     * @return \Application\Entity\Databases1
     */
    public function getDatabases1()
    {
        return $this->databases1;
    }

    /**
     * Set Communities entity (many to one).
     *
     * @param \Application\Entity\Communities $communities
     * @return \Application\Entity\Answers
     */
    public function setCommunities(Communities $communities = null)
    {
        $this->communities = $communities;

        return $this;
    }

    /**
     * Get Communities entity (many to one).
     *
     * @return \Application\Entity\Communities
     */
    public function getCommunities()
    {
        return $this->communities;
    }

    /**
     * Set Webservers entity (many to one).
     *
     * @param \Application\Entity\Webservers $webservers
     * @return \Application\Entity\Answers
     */
    public function setWebservers(Webservers $webservers = null)
    {
        $this->webservers = $webservers;

        return $this;
    }

    /**
     * Get Webservers entity (many to one).
     *
     * @return \Application\Entity\Webservers
     */
    public function getWebservers()
    {
        return $this->webservers;
    }

    /**
     * Set VersioningSystems entity (many to one).
     *
     * @param \Application\Entity\VersioningSystems $versioningSystems
     * @return \Application\Entity\Answers
     */
    public function setVersioningSystems(VersioningSystems $versioningSystems = null)
    {
        $this->versioningSystems = $versioningSystems;

        return $this;
    }

    /**
     * Get VersioningSystems entity (many to one).
     *
     * @return \Application\Entity\VersioningSystems
     */
    public function getVersioningSystems()
    {
        return $this->versioningSystems;
    }

    /**
     * Set ApplicationEnvironments entity (many to one).
     *
     * @param \Application\Entity\ApplicationEnvironments $applicationEnvironments
     * @return \Application\Entity\Answers
     */
    public function setApplicationEnvironments(ApplicationEnvironments $applicationEnvironments = null)
    {
        $this->applicationEnvironments = $applicationEnvironments;

        return $this;
    }

    /**
     * Get ApplicationEnvironments entity (many to one).
     *
     * @return \Application\Entity\ApplicationEnvironments
     */
    public function getApplicationEnvironments()
    {
        return $this->applicationEnvironments;
    }

    /**
     * Set Psrs entity (many to one).
     *
     * @param \Application\Entity\Psrs $psrs
     * @return \Application\Entity\Answers
     */
    public function setPsrs(Psrs $psrs = null)
    {
        $this->psrs = $psrs;

        return $this;
    }

    /**
     * Get Psrs entity (many to one).
     *
     * @return \Application\Entity\Psrs
     */
    public function getPsrs()
    {
        return $this->psrs;
    }

    public function __sleep()
    {
        return array('user_id', 'census_id', 'operating_system_id', 'framework_id', 'language_version_id', 'editor_id', 'database_id', 'community_id', 'webserver_id', 'versioning_system_id', 'application_environment_id', 'psr_id');
    }
}