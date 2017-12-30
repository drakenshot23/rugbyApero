<?php
/**
 * Created by IntelliJ IDEA.
 * User: Robert
 * Date: 30/12/2017
 * Time: 22:38
 */

class ConnectPDO extends PDO
{
    static protected $_instanceBD;

    public function __construct($dsn, $username, $passwd)
    {
        return parent::__construct($dsn, $username, $passwd);
    }

    static public function getInstanceBD($dsn, $username, $passwd)
    {
        if(!isset(self::$_instanceBD))
        {
            self::$_instanceBD = new self($dsn, $username, $passwd);
        }

        return self::$_instanceBD;
    }
}