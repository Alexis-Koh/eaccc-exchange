<?php
/**
 * User: M. Krivickiy
 */
namespace Exchange;

use Exchange\Systems\CashBox;
use Exchange\Object;

class System
{

    protected $objects = array();

    protected $config;

    /**
     * @return string
     */
    public function getRequest() {
        $request = array(
            'Header' => array(),
            'Body' => array()
        );

        foreach($this->getObjects() as $key => $objects) {
            foreach($objects as $object_key => $object) {
                $request['Body'][] = $object->toRequest();
            }
        }

        return $request;
    }

    /**
     * @param array $objects
     * @return System
     */
    public function setObjects($objects)
    {
        $this->objects = $objects;
        return $this;
    }

    /**
     * @return array
     */
    public function getObjects()
    {
        return $this->objects;
    }


    /**
     * @param Object $object
     * @return System
     */
    public function setObject(Object $object)
    {
        if(empty($this->objects[get_class($object)])) {
            $this->objects[get_class($object)] = array();
        }
        $this->objects[get_class($object)][] = $object;
        return $this;
    }

    /**
     * @return Object
     */
    public function getObject($name)
    {
        if(empty($this->objects[$name])) {
            return false;
        }
        return $this->objects[$name];
    }

    /**
     * @param mixed $config
     * @return System
     */
    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }

}