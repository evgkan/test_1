<?php

return [

    [
        'table' => 'category',
        'columns' => [
            'id' => \engine\Migration::TYPE_PK,
            'parent_id' => \engine\Migration::TYPE_INT,
            'name' => \engine\Migration::TYPE_STRING,
        ],
    ],

    [
        'table' => 'product',
        'columns' => [
            'id' => \engine\Migration::TYPE_PK,
            'name' => \engine\Migration::TYPE_STRING,
            'instock' => \engine\Migration::TYPE_BOOL,
            'cost' => \engine\Migration::TYPE_INT,
            'maker' => \engine\Migration::TYPE_STRING
        ],
    ],

    [
        'table' => 'product2category',
        'columns' => [
            'product_id' => \engine\Migration::TYPE_INT,
            'category_id' => \engine\Migration::TYPE_INT,
        ],
        /*
        'fk' => [
            'product_id' => 'product:id',
            'category_id' => 'category:id',
        ],
        */
    ],


];