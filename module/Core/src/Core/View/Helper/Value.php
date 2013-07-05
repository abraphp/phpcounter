<?php

namespace Core\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Helper que imprime variáveis na view
 * 
 * @category Application
 * @package View\Helper
 * @author  Elton Minetto <eminetto@coderockr.com>
 */
class Value extends AbstractHelper implements ServiceLocatorAwareInterface
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
     * @param  string $default       Valor default se a chave não for encontrada
     * @return string                Valor da chave
     */
    public function __invoke($data, $key, $default = '')
    {
        $escaper = $this->getView()->plugin('escapehtml');
        if (is_object($data) && property_exists($data,$key)) {
            return $escaper($data->$key);
        }

        if (is_array($data) && isset($data[$key])) {
            return $escaper($data[$key]);
        }

        return $default;
    }
}