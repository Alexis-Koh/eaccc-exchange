<?php

/**
 * User: M. Krivickiy
 */

namespace Exchange\Systems\CashBox;

use Exchange\Object;
use Exchange\Systems\CashBox\Accounts\Deleted;
use Exchange\Systems\CashBox\Accounts\Id;
use Exchange\Systems\CashBox\Accounts\Name;
use Exchange\Systems\CashBox\Accounts\Email;
use Exchange\Systems\CashBox\Accounts\Inn;
use Exchange\Systems\CashBox\Accounts\Phone;

class Accounts extends Object
{
    protected $type = 'Справочник.Контрагенты';

    public function __construct()
    {
        $this->setField(new Id())
            ->setField(new Name())
            ->setField(new Deleted())
            ->setField(new Phone())
            ->setField(new Email())
            ->setField(new Inn())
        ;
    }
}