<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Application\Entity\PaymentRanges
 *
 * @ORM\Entity(repositoryClass="PaymentRangesRepository")
 * @ORM\Table(name="payment_ranges", uniqueConstraints={@ORM\UniqueConstraint(name="uq_payment_ranges_range", columns={"minimum", "maximum"})})
 */
class PaymentRanges
{
    /**
     * @ORM\Id
     * @ORM\Column(type="smallint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="decimal", precision=11, scale=2)
     */
    protected $minimum;

    /**
     * @ORM\Column(type="decimal", precision=11, scale=2)
     */
    protected $maximum;

    /**
     * @ORM\OneToMany(targetEntity="SensitiveAnswers", mappedBy="paymentRanges")
     * @ORM\JoinColumn(name="payment_range_id", referencedColumnName="id", nullable=false)
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
     * @return \Application\Entity\PaymentRanges
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
     * Set the value of minimum.
     *
     * @param float $minimum
     * @return \Application\Entity\PaymentRanges
     */
    public function setMinimum($minimum)
    {
        $this->minimum = $minimum;

        return $this;
    }

    /**
     * Get the value of minimum.
     *
     * @return float
     */
    public function getMinimum()
    {
        return $this->minimum;
    }

    /**
     * Set the value of maximum.
     *
     * @param float $maximum
     * @return \Application\Entity\PaymentRanges
     */
    public function setMaximum($maximum)
    {
        $this->maximum = $maximum;

        return $this;
    }

    /**
     * Get the value of maximum.
     *
     * @return float
     */
    public function getMaximum()
    {
        return $this->maximum;
    }

    /**
     * Add SensitiveAnswers entity to collection (one to many).
     *
     * @param \Application\Entity\SensitiveAnswers $sensitiveAnswers
     * @return \Application\Entity\PaymentRanges
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
        return array('id', 'minimum', 'maximum');
    }
}