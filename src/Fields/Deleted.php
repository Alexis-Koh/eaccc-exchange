<?php

/**
 * User: M. Krivickiy
 */

namespace Exchange\Fields;

use Exchange\Field;

class Deleted extends Field
{
    protected $custom = false;
    protected $name = 'deleted';
    protected $externalName = 'DeletionMark';

    public function getValue()
    {
        return (bool) parent::getValue();
    }

}