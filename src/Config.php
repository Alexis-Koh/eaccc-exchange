<?php

/**
 * User: M. Krivickiy
 */

namespace Exchange;

class Config
{

    private $host;
    private $username;
    private $password;
    private $agencies = array();

    /**
     * @param mixed $host
     * @return Config
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $username
     * @return Config
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param array $agencies
     * @return Config
     */
    public function setAgencies($agencies)
    {
        $this->agencies = $agencies;
        return $this;
    }

    /**
     * @return array
     */
    public function getAgencies()
    {
        return $this->agencies;
    }

}