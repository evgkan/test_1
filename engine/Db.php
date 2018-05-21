<?php

namespace engine;

use PDO;

class Db
{

    /** @var null|PDO  */
    private static $db = null;


    /**
     * Db constructor.
     * @param $config
     */
    private function __construct($config)
    {
        $dsn = $config['db']['dsn'];
        $user = $config['db']['user'];
        $pass = $config['db']['pass'];
        self::$db = new PDO($dsn, $user, $pass, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]);
    }

    private function __clone () {}
    private function __wakeup () {}


    /**
     * @param $config
     * @return null|PDO
     */
    public static function init($config)
    {
        new self($config);
        return self::$db;
    }


    /**
     * @return null|PDO
     * @throws \Exception
     */
    public static function getInstance()
    {
        if (self::$db === null)
            throw new \Exception('Db class is not init.');

        return self::$db;
    }






}