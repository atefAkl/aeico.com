<?php

namespace CASHER\LIB\DB;

class PDODBHandler extends DBHandler
{

    private static $_instance;
    private static $_handler;

    public function __construct()
    {
        self::init();
    }
    public function __call($name, $arguments)
    {
        return call_user_func_array(array(&self::$_handler, $name), $arguments);
    }

    protected static function init()
    {
        try {
            self::$_handler = new \PDO(
                'mysql://hostname=' . DATABASE_HOST_NAME . ';dbname=' . DATABASE_DB_NAME,
                DATABASE_USER_NAME,
                DATABASE_PASSWORD
            );
            //echo 'connected';
        } catch (\PDOException $e) {
            //echo 'failed to connect' . $e->getMessage();
        }

    }
    public static function getInstance()
    {
        if (self::$_handler === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}