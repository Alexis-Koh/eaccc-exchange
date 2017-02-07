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
    protected static $collection;

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
    public static function getCollection()
    {
        return self::$collection;
    }

    /**
     * @param \MongoCollection $collection
     */
    public static function setCollection($collection)
    {
        self::$collection = $collection;
    }

    public static function addObject($object) {
        return self::getCollection()->insert($object);
    }

    public static function getSystem(System $system) {
        return array_search(get_class($system), self::$availableSystems);
    }

    public static function setReceived($messageNo) {
        $received = self::getCollection()->findAndModify(array(
            'request.Header.MessageNo' => (int)$messageNo
        ), array(
            '$set' => array(
                'received' => true
            )
        ));
    }

}