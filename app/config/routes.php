<?php

return [
    'api/get-product-by-id' => [
        'controller' => 'api',
        'action' => 'getProductById',
    ],
    'api/get-products-by-name-substring' => [
        'controller' => 'api',
        'action' => 'getProductsByNameSubstring',
    ],
    'api/get-products-by-makers' => [
        'controller' => 'api',
        'action' => 'getProductsByMakers',
    ],
    // get products only in one category
    'api/get-products-by-category' => [
        'controller' => 'api',
        'action' => 'getProductsByCategory',
    ],
    // get products in category recursively (with subcategories)
    'api/get-products-by-category-rec' => [
        'controller' => 'api',
        'action' => 'getProductsByCategoryRecursively',
    ],
];