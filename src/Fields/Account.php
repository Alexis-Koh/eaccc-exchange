<?php

/**
 * User: M. Krivickiy
 */

namespace Exchange\Fields;

use Exchange\Field;

class Account extends Field
{
    protected $custom = false;
    protected $name = 'account_id';
    protected $externalName = 'Контрагент';
}