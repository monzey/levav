<?php

use Phalcon\Loader;

$loader = new Loader();

$loader->registerFiles(
    [
        '../vendor/autoload.php'
    ]
);

$loader->registerNamespaces(
    [
        'Levav\Controller' => 'src/controllers',
        'Levav' => 'src/'
    ]
);

$loader->register();
