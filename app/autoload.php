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
        'Levav\Controller' => __DIR__ . '/src/controllers/',
        'Levav\Resource' => __DIR__ . '/src/resources/',
        'Levav\Model' => __DIR__ . '/src/model/',
        'Levav\Model\Serializer' => __DIR__ . '/src/model/serializers/',
        'Levav' => __DIR__ . '/src/'
    ]
);

$loader->register();
