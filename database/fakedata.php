<?php

return [
    'category' => [
        ['id' => 1, 'parent_id' => 0, 'name' => 'cat1'],
        ['id' => 2, 'parent_id' => 0, 'name' => 'cat2'],
        ['id' => 3, 'parent_id' => 1, 'name' => 'cat1_1'],
        ['id' => 4, 'parent_id' => 1, 'name' => 'cat1_2'],
    ],
    'product' => [
        ['id' => 1, 'name' => 'product1', 'instock' => 1, 'cost' => 100, 'maker' => 'maker1'],
        ['id' => 2, 'name' => 'product2', 'instock' => 1, 'cost' => 101, 'maker' => 'maker1'],
        ['id' => 3, 'name' => 'product3', 'instock' => 0, 'cost' => 102, 'maker' => 'maker2'],
    ],
    'product2category' => [
        ['product_id' => 1, 'category_id' => 1],
        ['product_id' => 1, 'category_id' => 2],
        ['product_id' => 1, 'category_id' => 3],
        ['product_id' => 1, 'category_id' => 4],
        ['product_id' => 2, 'category_id' => 3],
        ['product_id' => 3, 'category_id' => 4],
    ],

];