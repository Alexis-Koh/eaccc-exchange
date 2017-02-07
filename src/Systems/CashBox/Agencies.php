<?php

/**
 * User: M. Krivickiy
 */

namespace Exchange\Systems\CashBox;

use Exchange\Object;
use Exchange\Systems\CashBox\Agencies\Deleted;
use Exchange\Systems\CashBox\Agencies\Id;
use Exchange\Systems\CashBox\Agencies\Name;

class Agencies extends Object
{
    protected $type = 'Справочник.СтруктурныеЕдиницы';

    public function __construct()
    {
        $this->setField(new Id())
            ->setField(new Name())
            ->setField(new Deleted());
    }
}