<?php

namespace engine;

use engine\Db;
use PDO;

abstract class Model
{

    protected static $table;


    /**
     * @param $sql
     * @param array $params
     * @return bool
     * @throws \Exception
     */

    private static function query($sql, $params = [])
    {
        $db = Db::getInstance();
        $stmt = $db->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue(':'.$key, $val);
        }
        $stmt->execute();
        return $stmt;
    }

    protected static function rows($sql, $params = [])
    {
        $result = self::query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    protected static function column($sql, $params = [])
    {
        $result = self::query($sql, $params);
        return $result->fetchColumn();
    }

    protected static function getFilledModel($data)
    {
        $model = new static();
        foreach ($model->fields() as $field) {
            $model->{$field} = isset($data[$field]) ? $data[$field] : null;
        }
        return $model;
    }




    /**
     * @param $id
     * @return Model|null
     */
    public static function findById($id)
    {
        $table = static::$table;
        $rows = self::rows("SELECT * FROM $table WHERE id=:id", ['id' => $id]);
        if (empty($rows))
            return null;
        $row = $rows[0];
        return self::getFilledModel($row);
    }





    public static function findAllAsArray()
    {
        $table = static::$table;
        $result = self::rows("SELECT * FROM $table");
        return $result;
    }


    /**
     * @return array
     */
    public static function findAll()
    {
        $rows = self::findAllAsArray();
        $result = [];
        foreach ((array)$rows as $row) {
            $result[] = self::getFilledModel($row);
        }
        return $result;
    }


    //todo сделать экранирование!!!
    //todo сделать валидацию параметров


    public function getAttrs()
    {
        $result = [];
        foreach ($this->fields() as $field) {
            $result[$field] = isset($this->$field) ? $this->$field : null;
        }
        return $result;
    }


}