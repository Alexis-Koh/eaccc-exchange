<?php

/**
 * User: M. Krivickiy
 */

namespace Exchange\Systems\CashBox;

use Exchange\Object;

use Exchange\Systems\CashBox\Accounts\Id;
use Exchange\Systems\CashBox\Accounts\Name;

class Moneyorder extends Object
{

    protected $type = 'Документ.РасходДСПлан';

    public function __construct()
    {


        $this->setField(new Name())
            ->setField(new DescriptionAnalytic())
            ->setField(new Description())
            ->setField(new Amount())
            ->setField(new Currency())
            ->setField(new Author())
            ->setField(new Agency())
            ->setField(new Project())
            ->setField(new Account())
            ->setField(new Period())
            ->setField(new PaymentDate())
            ->setField(new Method())
            ->setField(new Payee())
            ->setField(new PayeeAccount())
            ->setField(new Comments())
            ->setField(new OrderDate())
            ->setField(new PayItem())
            ->setField(new ApprovedBy())
            ->setField(new CrmId())
            ->setField(new PayerId())
            ->setField(new Urgent())
            ->setField(new UrgentComment())
            ->setField(new HasAttachments())
            ->setField(new Deleted())
            ->setField(new Reserve())
            ->setField(new AgencyId())
            ->setField(new Sheet());


        ;
    }




    public function loadBean(\SugarBean $bean) {
        /** @var Field $field */
        foreach($this->getFields() as $key => $field) {



            $this->fields[$key]->setValue($bean->{$field->getName()});
        }
    }

}