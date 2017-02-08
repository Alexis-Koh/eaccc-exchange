<?php

/**
 * User: M. Krivickiy
 */

namespace Exchange\Systems\CashBox;

use Exchange\Object;
use Exchange\Systems\CashBox\Projects\Account;
use Exchange\Systems\CashBox\Projects\Agency;
use Exchange\Systems\CashBox\Projects\Deleted;
use Exchange\Systems\CashBox\Projects\Id;
use Exchange\Systems\CashBox\Projects\Name;

class Projects extends Object
{
    protected $type = 'Справочник.Проекты';

    public function __construct()
    {
        $this->setField(new Id())
            ->setField(new Name())
            ->setField(new Deleted())
            ->setField(new Agency())
            ->setField(new Account())
        ;
    }
}