<?php

namespace engine;

class Migration
{
    const TYPE_PK = 'pk';
    const TYPE_INT = 'int';
    const TYPE_STRING = 'string';
    const TYPE_BOOL = 'bool';


    private static function types()
    {
        return [
            self::TYPE_PK => 'INT(11) NOT NULL AUTO_INCREMENT',
            self::TYPE_INT => 'INT(11)',
            self::TYPE_STRING => 'VARCHAR(255)',
            self::TYPE_BOOL => 'TINYINT(1)',
        ];
    }


    public static function getSqlType($type)
    {
        $types = self::types();
        return isset($types[$type])? $types[$type]: null;
    }


}