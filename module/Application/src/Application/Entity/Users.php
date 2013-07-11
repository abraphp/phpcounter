<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Application\Entity\Users
 *
 * @ORM\Entity(repositoryClass="UsersRepository")
 * @ORM\Table(name="users", indexes={@ORM\Index(name="cities_users_fk", columns={"city_id"})}, uniqueConstraints={@ORM\UniqueConstraint(name="un_users_email", columns={"email"})})
 */
class Users
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $password;

    /**
     * @ORM\OneToMany(targetEntity="Answers", mappedBy="users")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $answers;

    /**
     * @ORM\OneToMany(targetEntity="Profiles", mappedBy="users")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $profiles;

    /**
     * @ORM\ManyToOne(targetEntity="Cities", inversedBy="users")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="city_id", nullable=false)
     */
    protected $cities;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->profiles = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Application\Entity\Users
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
     * Set the value of email.
     *
     * @param string $email
     * @return \Application\Entity\Users
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of password.
     *
     * @param string $password
     * @return \Application\Entity\Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Add Answers entity to collection (one to many).
     *
     * @param \Application\Entity\Answers $answers
     * @return \Application\Entity\Users
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
     * Add Profiles entity to collection (one to many).
     *
     * @param \Application\Entity\Profiles $profiles
     * @return \Application\Entity\Users
     */
    public function addProfiles(Profiles $profiles)
    {
        $this->profiles[] = $profiles;

        return $this;
    }

    /**
     * Get Profiles entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProfiles()
    {
        return $this->profiles;
    }

    /**
     * Set Cities entity (many to one).
     *
     * @param \Application\Entity\Cities $cities
     * @return \Application\Entity\Users
     */
    public function setCities(Cities $cities = null)
    {
        $this->cities = $cities;

        return $this;
    }

    /**
     * Get Cities entity (many to one).
     *
     * @return \Application\Entity\Cities
     */
    public function getCities()
    {
        return $this->cities;
    }

    public function __sleep()
    {
        return array('id', 'city_id', 'email', 'password');
    }
}