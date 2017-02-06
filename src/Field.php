<?php

/**
 * User: M. Krivickiy
 */

namespace Exchange;

class Field
{

    /**
     * @var bool
     */
    protected $custom = false;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $externalName;

    /**
     * @var string
     */
    protected $value;

    /**
     * @param bool $isCustom
     * @return Field
     */
    public function setIsCustom($isCustom)
    {
        $this->custom = $isCustom;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCustom()
    {
        return $this->custom;
    }

    /**
     * @param string $name
     * @return Field
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        if($this->isCustom()) {
            return sprintf('%s_c', $this->name);
        }
        return $this->name;
    }

    /**
     * @param string $externalName
     * @return Field
     */
    public function setExternalName($externalName)
    {
        $this->externalName = $externalName;
        return $this;
    }

    /**
     * @return string
     */
    public function getExternalName()
    {
        return $this->externalName;
    }

    /**
     * @param string $value
     * @return Field
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

}