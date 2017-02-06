<?php

/**
 * User: M. Krivickiy
 */

namespace Exchange\Systems;

use Exchange\System;
use Exchange\Systems\CashBox\Agencies;

class CashBox extends System
{

    public function __construct()
    {
        $this->setObject(new Agencies());
    }

}