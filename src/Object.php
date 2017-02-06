<?php

/**
 * User: M. Krivickiy
 */

namespace Exchange;

use Exchange\Field;

class Object
{

    protected $fields = array();
    protected $type = 'Справочник.СтруктурныеЕдиницы';

    /**
     * @param array $fields
     * @return Object
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param string $name
     * @return bool|Field
     */
    public function getField($name)
    {
        if (empty($this->fields[$name])) {
            return false;
        }
        return $this->fields[$name];
    }

    /**
     * @param Field $field
     * @return Object
     */
    public function setField(Field $field)
    {
        $this->fields[get_class($field)] = $field;
        return $this;
    }

    /**
     * @param \SugarBean $bean
     */
    public function loadBean(\SugarBean $bean) {
        /** @var Field $field */
        foreach($this->getFields() as &$field) {
            $field->setValue($bean->{$field->getName()});
        }
    }

    public function toRequest() {
        $request = array();
        $request['Type'] = $this->type;

        /** @var Field $field */
        foreach($this->getFields() as $field) {
            $request[$field->getExternalName()] = $field->getValue();
        }
        return $request;
    }

}