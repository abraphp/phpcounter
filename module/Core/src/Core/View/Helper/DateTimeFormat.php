<?php

namespace Core\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Helper que imprime datas
 * 
 * @category Core
 * @package View\Helper
 * @author  Romulo Busatto <romulobusatto@unochapeco.edu.br>
 */
class DateTimeFormat extends AbstractHelper implements ServiceLocatorAwareInterface
{

    /**
     * Set the service locator.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return CustomHelper
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    /**
     * Get the service locator.
     *
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * Verifica se a chave existe no array ou objeto e retorna seu valor
     * @param  array|object $data    Conjunto de dados a pesquisar
     * @param  string $key           Chave a pesquisar
     * @param  string $dateFormat    Formato da data, default d/m/Y, para horas passar d/m/Y H:i:s
     * @param  string $default       Valor default se a chave não for encontrada
     * @return string                Valor da chave
     */
    public function __invoke($data, $key, $dateFormat = 'd/m/Y', $default = '')
    {
        if (is_string($data) && $data) {
            $data = $this->createFromFormat($data);
            if ($data instanceof \DateTime) {
                return $data->format($dateFormat);
            }
        }
        
        if (is_object($data) && isset($data->$key) && !is_null($data->$key)) {
            
            if (!($data->$key instanceof \DateTime)) {
                $data->$key = $this->createFromFormat($data->$key);
            }
            if ($data->$key instanceof \DateTime) {
                return $data->$key->format($dateFormat);
            }
        }
        if (is_array($data) && isset($data[$key]) && !is_null($data[$key])) {
            
            if (!($data[$key] instanceof \DateTime)) {
                $data[$key] = $this->createFromFormat($data[$key]);
            }

            if ($data[$key] instanceof \DateTime) {
                return $data[$key]->format($dateFormat);
            }
        }

        return $default;
    }

    private function createFromFormat($value)
    {
        $dateFormats = array(
            /** MySQL: 2012-11-27 16:01:04 */
            'Y-m-d H:i:s',
            /** Oracle Unochapecó CLI: 27/11/2012 */
            'd/m/Y',
            /** Oracle Unochapecó CLI: 27/11/12 */
            'd/m/y',
            /** Fixtures */
            'd/m/Y H:i:s',
            'd/m/Y H:i',
        );


        foreach ($dateFormats as $format) {
            $date = \DateTime::createFromFormat($format, $value);

            $errors = \DateTime::getLastErrors();

            if ($errors['warning_count'] === 0 && $date != false) {                
                return $date;
            }
        }

        return null;
    }

}