<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Application\Entity\SensitiveAnswers
 *
 * @ORM\Entity(repositoryClass="SensitiveAnswersRepository")
 * @ORM\Table(name="sensitive_answers", indexes={@ORM\Index(name="census_sensitive_answers_fk", columns={"census_id"}), @ORM\Index(name="working_regimes_sensitive_answers_fk", columns={"working_regime_id"}), @ORM\Index(name="payment_ranges_payment_ranges_answers_fk", columns={"payment_range_id"})})
 */
class SensitiveAnswers
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $census_id;

    /**
     * @ORM\ManyToOne(targetEntity="Census", inversedBy="sensitiveAnswers")
     * @ORM\JoinColumn(name="census_id", referencedColumnName="id", nullable=false)
     */
    protected $census;

    /**
     * @ORM\ManyToOne(targetEntity="PaymentRanges", inversedBy="sensitiveAnswers")
     * @ORM\JoinColumn(name="payment_range_id", referencedColumnName="id", nullable=false)
     */
    protected $paymentRanges;

    /**
     * @ORM\ManyToOne(targetEntity="WorkingRegimes", inversedBy="sensitiveAnswers")
     * @ORM\JoinColumn(name="working_regime_id", referencedColumnName="id", nullable=false)
     */
    protected $workingRegimes;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Application\Entity\SensitiveAnswers
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
     * Set the value of census_id.
     *
     * @param integer $census_id
     * @return \Application\Entity\SensitiveAnswers
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
     * Set Census entity (many to one).
     *
     * @param \Application\Entity\Census $census
     * @return \Application\Entity\SensitiveAnswers
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
     * Set PaymentRanges entity (many to one).
     *
     * @param \Application\Entity\PaymentRanges $paymentRanges
     * @return \Application\Entity\SensitiveAnswers
     */
    public function setPaymentRanges(PaymentRanges $paymentRanges = null)
    {
        $this->paymentRanges = $paymentRanges;

        return $this;
    }

    /**
     * Get PaymentRanges entity (many to one).
     *
     * @return \Application\Entity\PaymentRanges
     */
    public function getPaymentRanges()
    {
        return $this->paymentRanges;
    }

    /**
     * Set WorkingRegimes entity (many to one).
     *
     * @param \Application\Entity\WorkingRegimes $workingRegimes
     * @return \Application\Entity\SensitiveAnswers
     */
    public function setWorkingRegimes(WorkingRegimes $workingRegimes = null)
    {
        $this->workingRegimes = $workingRegimes;

        return $this;
    }

    /**
     * Get WorkingRegimes entity (many to one).
     *
     * @return \Application\Entity\WorkingRegimes
     */
    public function getWorkingRegimes()
    {
        return $this->workingRegimes;
    }

    public function __sleep()
    {
        return array('id', 'census_id', 'payment_range_id', 'working_regime_id');
    }
}