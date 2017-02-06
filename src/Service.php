<?php

/**
 * User: M. Krivickiy
 */

namespace Exchange;

use Exchange\Config;

class Service
{

    protected static  $systems = array(
        'CashBox' => 'Exchange\Systems\CashBox',
        'YourHumanResourceAdvisor' => 'Exchange\Systems\YourHumanResourceAdvisor',
    );

    /**
     * @param \SugarBean $bean
     * @return bool|System
     */
    public static function system($bean) {
        if(empty(self::$systems[$bean->system_c]) || !class_exists(self::$systems[$bean->system_c])) {
            return false;
        }
        return new self::$systems[$bean->system_c]();
    }

}

echo 'Service';