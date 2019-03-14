<?php 
class abstractModel 
{
    const DATA_TYPE_STR = PDO::PARAM_STR;
    const DATA_TYPE_INT = PDO::PARAM_INT;
    const DATA_TYPE_BOL = PDO::PARAM_BOOL;
    const DATA_TYPE_DEC = 4;

    private function bindValues(PDOStatement $stmt) {
        foreach(static::$tableSchema as $colName => $type) {
            $stmt->bindValue(":{$colName}", "{$this->$colName}", $type);
        }
    }
    public static function buildSqlNamedParams() {
            $nParams = '';
        foreach(static::$tableSchema as $colName => $type) {
            $nParams .= $colName . ' = :' . $colName . ', '; 
        }
        return trim($nParams, ', ');
    }
    private function create() {
        global $connect;

        $sql = 'INSERT INTO ' . static::$tableName . ' SET ' . self::buildSqlNamedParams();
        $stmt = $connect->prepare($sql);
        $this->bindValues($stmt);
        return $stmt->execute();
    }
    private function update() {
        global $connect;

        $sql = 'UPDATE ' . static::$tableName . ' SET ' . self::buildSqlNamedParams() . ' WHERE ' . static::$primaryKey . ' = ' . $this->{static::$primaryKey};
        $stmt = $connect->prepare($sql);
        $this->bindValues($stmt);
        $stmt->execute();
        return $stmt->execute();
    }
    public function save () {
        return $this->{static::$primaryKey} === null ? $this->create() : $this->update();
    }

    public function delete() {
        global $connect;

        $sql = 'DELETE FROM ' . static::$tableName . ' WHERE ' . static::$primaryKey . ' = ' . $this->{static::$primaryKey};
        $stmt = $connect->prepare($sql);
        return $stmt->execute();
        
    }

    public static function getAll() {
        global $connect;

        $sql = 'SELECT * FROM ' . static::$tableName;
        $stmt = $connect->prepare($sql);
        return $stmt->execute() === true ? $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema)) : false;
    }
    
    public static function getByPK($pk) {
        global $connect;

        $sql = 'SELECT * FROM ' . static::$tableName . ' WHERE ' . static::$primaryKey . ' = "' . $pk . '"';
        $stmt = $connect->prepare($sql);
        if ($stmt->execute() === true) {
            $obj = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
            return array_shift($obj);
        }
        return false;
    }
 }