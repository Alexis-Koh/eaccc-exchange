<?php

/**
 * User: M. Krivickiy
 */

namespace Exchange\Systems\CashBox;

use Exchange\Object;
use Exchange\Systems\CashBox\Agencies\Id;
use Exchange\Systems\CashBox\Agencies\Name;

class Agencies extends Object
{
    public function __construct()
    {
        $this->setField(new Id())
            ->setField(new Name());
    }
}