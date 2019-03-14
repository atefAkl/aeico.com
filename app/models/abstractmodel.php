<?php
namespace CASHER\Models;

use CASHER\LIB\DB\DBHandler;

class AbstractModel {
    const BOOLEAN_DATA_TYPE 	= \PDO::PARAM_BOOL;
 	const STRING_DATA_TYPE 		= \PDO::PARAM_STR;
 	const INTEGER_DATA_TYPE 	= \PDO::PARAM_INT;
 	const DECIMAL_DATA_TYPE 	= 4;
 	const DATE_DATA_TYPE 	    = 5;

 	// validate date ranges is between 01-01-1000 and 31-12-9999
 	const  VALIDATE_DATE_STRING = '/^[1-9][1-9][1-9][0-1]?[0-2]-(?:[0-2]?[1-9]|[3][0-1])$/';
    // TODO::check the valid dates in MySQL to create proper pattern
    const VALIDATE_DATE_NUMERIC = '^\d{6,8}$';
    const DEFAULT_MYSQL_DATE = '1970-01-01';

    private static $db;

 	private static function SQLNamedParams() {
		$namedParams = '';

		foreach (static::$tableSchema as $colName => $type) {
			$namedParams .= $colName . ' = :' . $colName . ', ';
		}
		return trim($namedParams, ', ');
	}

	private function SQLBindedParams(\PDOStatement $stmt) {

		foreach (static::$tableSchema as $colName => $type) {

				$stmt->bindValue(":{$colName}", $this->$colName, $type);

		}
	}
	private function create() {
 	    $sql = 'INSERT INTO ' . static::$tableName . ' SET ' . self::SQLNamedParams();
 	    $stmt = DBHandler::factory()->prepare($sql);
        $this->SQLBindedParams($stmt);
        if ($stmt->execute()) {
            echo 'saved';
            $this->{static::$primaryKey} =  DBHandler::factory()->lastInsertId();
            return true;
        }
 	    return false;
    }

    private function update() {
        $sql = 'UPDATE ' . static::$tableName . ' SET ' . self::SQLNamedParams() . ' WHERE ' . static::$primaryKey . ' = ' . $this->{static::$primaryKey} ;
        $stmt = DBHandler::factory()->prepare($sql);
        $this->SQLBindedParams($stmt);
        return $stmt->execute();
    }

    public function save () {
		return $this->{static::$primaryKey}  === null ? $this->create() : $this->update();
	}

	public function delete () {
		$sql = 'DELETE FROM ' . static::$tableName . ' WHERE ' . static::$primaryKey . ' = ' . $this->{static::$primaryKey } ;
		$stmt = DBHandler::factory()->prepare($sql);
		return $stmt->execute();
	}

	public static function getAll() {
		$sql = 'SELECT * FROM ' . static::$tableName;
        $stmt = DBHandler::factory()->prepare($sql);
		$stmt->execute();
  		if (method_exists(get_called_class(), '__construct')) {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
        } else {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        }
		if (is_array($results) && !empty($results)) {
            $generator =function () use ($results) {
                foreach ($results as $result) {
                    yield $result;
                }
            };
            return $generator();
        }
		return false;
	}
	public static function getByPK($pk) {

		$sql = 'SELECT * FROM ' . static::$tableName . ' WHERE ' . static::$primaryKey . " = '{$pk}'";
		$stmt = DBHandler::factory()->prepare($sql);
        $stmt->execute();
        if (method_exists(get_called_class(), '__construct')) {
            $result = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
        } else {
            $result = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class());
        }
            return array_shift($result);


		return false;
	}
	public static function get ($sql, $option = array()) {
 	    $stmt = DBHandler::factory()->prepare($sql);
        if (!empty($option)) {
            foreach ($option as $colName => $type) {
                if ($type == 4) {
                    $sanitizedValue = filter_var($type[1], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $stmt->bindValue(":{$colName}", $sanitizedValue);
                } elseif ($type == 5) {
                    if (!preg_match(self::VALIDATE_DATE_STRING, $type[1]) || !preg_match(self::VALIDATE_DATE_NUMERIC, $type[1])) {
                        $stmt->bindValue(":{$colName}", self::DEFAULT_MYSQL_DATE);
                        continue;
                    }
                    $stmt->bindValue(":{$colName}", $type[1]);
                } else {
                    $stmt->bindValue(":{$colName}", $type[1], $type[0]);
                }
            }
            $stmt->execute();
            if (method_exists(get_called_class(), '__construct')) {
                $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
            } else {
                $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class());
            }
            if (is_array($results) && !empty($results)) {
                $generator =function () use ($results) {
                    foreach ($results as $result) {
                        yield $result;
                    }
                };
                return $generator();
            }
            return false;
        }
    }
 }