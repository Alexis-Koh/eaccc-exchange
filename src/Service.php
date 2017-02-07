<?php

/**
 * User: M. Krivickiy
 */

namespace Exchange;

use Exchange\Config;
use Exchange\System;

class Service
{

    protected static $systems = array();
    /** @var  \MongoCollection $collection */
    protected static $messageCollection;
    /** @var  \MongoCollection $queueCollection */
    protected static $queueCollection;

    protected static  $availableSystems = array(
        'CashBox' => 'Exchange\Systems\CashBox',
        'YourHumanResourceAdvisor' => 'Exchange\Systems\YourHumanResourceAdvisor',
    );

    /**
     * @param \SugarBean $bean
     * @return bool|System
     */
    public static function system($bean) {
        if(empty(self::$availableSystems[$bean->system_c]) || !class_exists(self::$availableSystems[$bean->system_c])) {
            return false;
        }

        if(empty(self::$systems[$bean->system_c])) {
            self::$systems[$bean->system_c] = new self::$availableSystems[$bean->system_c]();
        }

        return self::$systems[$bean->system_c];
    }

    /**
     * @return array
     */
    public static function getSystems()
    {
        return self::$systems;
    }

    /**
     * @param array $systems
     */
    protected static function setSystems($systems)
    {
        self::$systems = $systems;
    }

    /**
     * @return \MongoCollection
     */
    public static function getMessagesCollection()
    {
        return self::$messageCollection;
    }

    /**
     * @param \MongoCollection $collection
     */
    public static function setMessagesCollection($collection)
    {
        self::$messageCollection = $collection;
    }

    /**
     * @return \MongoCollection
     */
    public static function getQueueCollection()
    {
        return self::$queueCollection;
    }

    /**
     * @param \MongoCollection $collection
     */
    public static function setQueueCollection($collection)
    {
        self::$queueCollection = $collection;
    }

    public static function addObject($object) {
        return self::getQueueCollection()->insert($object);
    }

    /**
     * @param \Exchange\System $system
     * @return string
     */
    public static function getSystem(System $system) {
        return array_search(get_class($system), self::$availableSystems);
    }

    /**
     * @param $messageNo
     * @param string $system
     * @return bool
     */
    public static function setReceived($messageNo, $system = 'CashBox') {
        $received = self::getMessagesCollection()->findAndModify(array(
            'request.Header.MessageNo' => (int)$messageNo,
            'system' => $system
        ), array(
            '$set' => array(
                'received' => true
            )
        ));

        if(!$received) {
            return false;
        }

        foreach ($received['objects'] as $object) {
            self::getQueueCollection()->remove(
                array(
                    '_id' => $object
                )
            );
        }
        return true;
    }

    public static function getLastMessageNo($system = 'CashBox') {
        $lastMessage = self::getMessagesCollection()
            ->find(array('system' => $system))
            ->sort(array("request.Header.MessageNo" => -1))
            ->limit(1)
            ->next();

        return empty($lastMessage) ? 1 : $lastMessage['request']['Header']['MessageNo'];
    }

}