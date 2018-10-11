<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12/09/18
 * Time: 23:06
 */

class PJBase
{

    public  function prepare(){
        return $this->dismount($this);
    }

    protected  function dismount($object) {
        $reflectionClass = new ReflectionClass(get_class($object));
        $array = array();
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $array[$property->getName()] = $property->getValue($object);

            if($property->getName() == 'split' && $this->getSplit() != null )
                $array[$property->getName()] = array($this->dismount($this->getSplit()));

            if($property->getName() == 'cobrancas' && $this->getCobrancas() != null )
                $array[$property->getName()] = $this->getCobrancas();

            $property->setAccessible(false);
        }
        return $array;
    }


}