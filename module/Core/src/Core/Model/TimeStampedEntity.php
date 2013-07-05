<?php
namespace Core\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Exception\InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

/**
 * Classe das entidades que possuem registro de criação
 * @category   Core
 * @package    Model
 * @author     Elton Minetto<eminetto@coderockr.com>
 */
class TimeStampedEntity extends Entity
{
    /**
     * @ORM\Column(type="datetime")
     * @var datetime
     */
    protected $created;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     * @var datetime
     */
    protected $updated;


    public function __construct()
    {
        $this->created = new DateTime();
    }

    
    /**
     * Sobrecarrega o método da classe pai para atualizar o campo criado
     * @param array $data Dados
     * @return void
     */
    public function setData($data)
    {
        parent::setData($data);
        if (!$this->created) {
            $date = \DateTime::createFromFormat('d/m/Y H:i:s',date('d/m/Y H:i:s'));                     
            $this->created = $date;
        }
    }

    /**
     * Sobrecarrega o método da classe pai para atualizar o campo criado
     * @param array $data Dados
     * @return void
     */
    public function getData()
    {
        if (!$this->created) {            
            $date = \DateTime::createFromFormat('d/m/Y H:i:s',date('d/m/Y H:i:s'));                   
            $this->created = $date;                
        }
        return parent::getData();
    }
}