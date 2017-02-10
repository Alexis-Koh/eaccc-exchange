<?php

/**
 * User: M. Krivickiy
 */

namespace Exchange\Systems\CashBox;

use Exchange\Object;

//use Exchange\Systems\CashBox\Accounts\Id;
//use Exchange\Systems\CashBox\Accounts\Name;




use Exchange\Systems\CashBox\Moneyorder\Name;
use Exchange\Systems\CashBox\Moneyorder\DescriptionAnalytic;
use Exchange\Systems\CashBox\Moneyorder\Description;
use Exchange\Systems\CashBox\Moneyorder\Amount;
use Exchange\Systems\CashBox\Moneyorder\Currency;
use Exchange\Systems\CashBox\Moneyorder\Author;
use Exchange\Systems\CashBox\Moneyorder\Agency;
use Exchange\Systems\CashBox\Moneyorder\Project;
use Exchange\Systems\CashBox\Moneyorder\Account;
use Exchange\Systems\CashBox\Moneyorder\Period;
use Exchange\Systems\CashBox\Moneyorder\PaymentDate;
use Exchange\Systems\CashBox\Moneyorder\Method;
use Exchange\Systems\CashBox\Moneyorder\Payee;
use Exchange\Systems\CashBox\Moneyorder\PayeeAccount;
use Exchange\Systems\CashBox\Moneyorder\Comments;
use Exchange\Systems\CashBox\Moneyorder\OrderDate;
use Exchange\Systems\CashBox\Moneyorder\PayItem;
use Exchange\Systems\CashBox\Moneyorder\ApprovedBy;
use Exchange\Systems\CashBox\Moneyorder\CrmId;
use Exchange\Systems\CashBox\Moneyorder\PayerId;
use Exchange\Systems\CashBox\Moneyorder\Urgent;
use Exchange\Systems\CashBox\Moneyorder\UrgentComment;
use Exchange\Systems\CashBox\Moneyorder\HasAttachments;
use Exchange\Systems\CashBox\Moneyorder\Deleted;
use Exchange\Systems\CashBox\Moneyorder\Reserve;
use Exchange\Systems\CashBox\Moneyorder\AgencyId;
use Exchange\Systems\CashBox\Moneyorder\Sheet;



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