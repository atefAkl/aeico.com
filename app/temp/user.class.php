<?php

class User extends abstractModel
{
    private $userId;
    private $userName;
    private $userFull;
    private $userMail;
    private $userPass;
    private $userDOB;
    private $userPos;

    
    protected static $primaryKey = 'userId';
    protected static $tableName      = 'appusers';
    protected static $tableSchema    = array (
        'userName'  => self::DATA_TYPE_STR,
        'userFull'  => self::DATA_TYPE_STR,
        'userMail'  => self::DATA_TYPE_STR,
        'userPass'  => self::DATA_TYPE_STR,
        'userDOB'   => self::DATA_TYPE_STR,
        'userPos'   => self::DATA_TYPE_INT
    );
    public function __construct ($userFull, $userName, $userMail, $userPass, $userDOB, $userPos) {
        global $connect;

        $this->userName = $userName;
        $this->userFull = $userFull;
        $this->userMail = $userMail;
        $this->userPass = $userPass;
        $this->userDOB  = $userDOB;
        $this->userPos  = $userPos;
        
    }
    public function __get($prop) {
        return $this->$prop;
    }

    public function setFull($name) {
        return $this->userFull = $name;
    }
}

