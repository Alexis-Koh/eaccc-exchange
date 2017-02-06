<?php

echo 'Systems';
/**
 * User: M. Krivickiy
 */
namespace Exchange;

use Exchange\Systems\CashBox;
use Exchange\Object;

class System
{

    protected $objects = array();

    /**
     * @return string
     */
    public function getMessage() {
        $request = array();

        return json_encode($request);
    }

    /**
     * @return array
     */
    public static function getAll() {
        $list = \BeanFactory::getBean('eaccc_sync1c_configs')->get_full_list();
        $configs = array();
        foreach ($list as $item) {
            if(!class_exists($item->system_c)) {

            }
            $configs[] = new $item->system_c();
        }

        return $configs;
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
        $this->objects[get_class($object)] = $object;
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
}