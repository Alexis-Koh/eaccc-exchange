<?php
/**
 * User: M. Krivickiy
 */
namespace Exchange;

use Exchange\Systems\CashBox;
use Exchange\Object;

class System
{
    protected $lastReceivedNo;
    /** @var  \MongoCollection $collection */
    protected $collection;

    protected $objects = array();

    protected $config;

    protected $transport;

    protected $objectsMapping = array();

    /**
     * @return array
     */
    public function getRequest() {
        $request = array(
            'Header' => new \stdClass()
        );

        $lastMessage = $this->getCollection()
            ->find(array('system' => Service::getSystem($this)))
            ->sort(array("request.Header.MessageNo" => -1))
            ->limit(1)
            ->next();

        $request['Header']->MessageNo = empty($lastMessage) ? 1 : $lastMessage['request']['Header']['MessageNo'] + 1;
        if(!empty($this->getLastReceivedNo())) {
            $request['Header']->ReceivedNo = $this->getLastReceivedNo();
        }

        if(count($this->getObjects()) > 0) {
            $request['Body'] = array();
        }

        foreach($this->getObjects() as $key => $objects) {
            foreach($objects as $object_key => $object) {
                $request['Body'][] = $object->toRequest();
            }
        }

        $request['Header']->Sign = self::getSign(json_encode($request, JSON_UNESCAPED_UNICODE));

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
        $items = array();
        foreach ($this->getObjects() as $objects) {
            /** @var Object $object */
            foreach($objects as $object) {
                $object->setProcessed(true);
                $items[] = $object->getMongoId();
            }
        }

        return $this->getCollection()->insert(
            array(
                'request' => $this->getRequest(),
                'objects' => $items,
                'received' => false,
                'system' => Service::getSystem($this)
            )
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

    public static function getSign($body) {
        global $sugar_config;
        $sign = md5($sugar_config['1c_config']['api_key'] . $body . $sugar_config['1c_config']['api_salt']);
        return $sign;
    }

    /**
     * @param mixed $transport
     * @return System
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * @return mixed
     */
    public function sent() {
        return $this->getTransport()->call('Отправить', array('Данные' => json_encode($this->getRequest())), 'ExchangeSuiteCRM');
    }

    /**
     * @return mixed
     */
    public function getLastReceivedNo()
    {
        return $this->lastReceivedNo;
    }

    /**
     * @param mixed $lastReceivedNo
     */
    public function setLastReceivedNo($lastReceivedNo)
    {
        $this->lastReceivedNo = $lastReceivedNo;
    }

    /**
     * @param array $objectsMapping
     * @return System
     */
    public function setObjectsMapping($objectsMapping)
    {
        $this->objectsMapping = $objectsMapping;
        return $this;
    }

    /**
     * @return array
     */
    public function getObjectsMapping()
    {
        return $this->objectsMapping;
    }

    /**
     * @param $module
     * @return bool|mixed
     */
    public function getObjectClass($module)
    {
        if(empty($this->objectsMapping[$module])) {
            return false;
        }
        return $this->objectsMapping[$module];
    }

}