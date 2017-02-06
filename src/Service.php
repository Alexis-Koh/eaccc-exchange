<?php

/**
 * User: M. Krivickiy
 */

namespace Exchange;

use Exchange\Config;

class Service
{

    protected static $systems = array();

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

}