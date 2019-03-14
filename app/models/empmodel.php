<?php

namespace CASHER\Models;

class EmpModel extends AbstractModel
{

    public $id;
    public $name;
    public $address;
    public $tax;
    public $salary;


    protected static $tableName = 'emp';
    protected static $tableSchema = array(
        'name'      =>  self::STRING_DATA_TYPE,
        'age'       =>  self::INTEGER_DATA_TYPE,
        'address'   =>  self::STRING_DATA_TYPE,
        'tax'       =>  self::DECIMAL_DATA_TYPE,
        'salary'    =>  self::DECIMAL_DATA_TYPE
    );

    protected static $primaryKey = 'id';
/*    public function __construct ($name, $age, $address, $tax, $salary) {
        $this->name     = $name;
        $this->age      = $age;
        $this->address  = $address;
        $this->tax      = $tax;
        $this->salary   = $salary;
    }*/

    public function getProp ($prop) {
        return $this->$prop;
    }
    public function getTableName () {
        return $this->$tableName;
    }

}