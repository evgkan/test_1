<?php

require __DIR__ . '/../engine/autoload.php';

$config = array_merge(
    require __DIR__ . '/../config/main.php',
    require __DIR__ . '/../app/config/main.php'
);

\engine\Db::init($config);

$router = new \engine\Router($config);
$router->run();