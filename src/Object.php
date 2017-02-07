<?php

/**
 * User: M. Krivickiy
 */

namespace Exchange;

use Exchange\Field;

class Object
{

    protected $fields = array();
    protected $type;
    /** @var  \MongoId $mongoId */
    protected $mongoId;
    /** @var  \MongoCollection $collection */
    protected $collection;

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
        foreach($this->getFields() as $key => $field) {
            $this->fields[$key]->setValue($bean->{$field->getName()});
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

    /**
     * @param \MongoCollection $collection
     * @return Object
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
        return $this;
    }

    /**
     * @return \MongoCollection
     */
    public function getCollection()
    {
        return $this->collection;
    }

    public function setProcessed($isProcessed) {
        $this->getCollection()->update(
            array('_id' => $this->getMongoId()),
            array(
                '$set' => array(
                    'processed' => (bool)$isProcessed
                )
            )
        );
    }

    /**
     * @param \MongoId $mongoId
     * @return Object
     */
    public function setMongoId($mongoId)
    {
        $this->mongoId = $mongoId;
        return $this;
    }

    /**
     * @return \MongoId
     */
    public function getMongoId()
    {
        return $this->mongoId;
    }

}