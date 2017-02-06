<?php
/**
 * User: M. Krivickiy
 */
namespace Exchange;

use Exchange\Systems\CashBox;
use Exchange\Object;

class System
{

    /** @var  \MongoCollection $collection */
    protected $collection;

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

        $lastMessage = $this->getCollection()->find()->sort(array('Header.MessageNo' => '-1'))->limit(1)->current();
        if(empty($lastMessage)) {
            $MessageNo = 1;
        }
        $MessageNo = empty($lastMessage) ? 1 : $lastMessage['Header']['MessageNo'] + 1;

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

    public function storeProcessed() {
        $this->getCollection()->insert(
            $this->getRequest()
        );
    }

    /**
     * @param \MongoCollection $collection
     * @return System
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
        return $this;
    }

    /**
     * @return \MongoCollection
     */
    public function getCollection()
    {
        return $this->collection;
    }

}