<?php

/**
 * User: M. Krivickiy
 */

namespace Exchange\Systems\CashBox;

use Exchange\Object;
use Exchange\Systems\CashBox\Payers\Deleted;
use Exchange\Systems\CashBox\Payers\Id;
use Exchange\Systems\CashBox\Payers\Name;

class Payers extends Object
{
    protected $type = 'Справочник.Кассы';

    public function __construct()
    {
        $this->setField(new Id())
            ->setField(new Name())
            ->setField(new Deleted());
    }
}