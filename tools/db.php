<?php
/**
 * Created by PhpStorm.
 * User: new1
 * Date: 2015/9/13
 * Time: 16:10
 */
header("Content-Type: text/html; charset=utf-8");
class db
{
    static private $_instance;
    static private $_connectSource;
    private $_dbConfig = array
    (
        'host' => '127.0.0.1',
        'user' => 'root',
        'password' => 'root',
        'database' => 'jdSchema15_10_29_01',
        'port' => 3307,
    );

    private function __construct()
    {
    }

    static public function getInstance()
    {
        if(!(self::$_instance instanceof self))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @return resource
     * @throws Exception
     */
    public function connect()
    {
        if(!self::$_connectSource)
        {
            self::$_connectSource = new mysqli($this->_dbConfig['host'], $this->_dbConfig['user'], $this->_dbConfig['password'], $this->_dbConfig['database'] , $this->_dbConfig['port']);
            if(!self::$_connectSource)
            {
                throw new Exception('mysql connect error '.mysqli_error());
                die('mysql connect error' . mysqli_error());
            }
            mysqli_query( self::$_connectSource, "SET NAMES utf8" );
        }
        return self::$_connectSource;
    }
}

