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
        'Levav\Resource' => 'src/resources',
        'Levav\Model' => 'src/model',
        'Levav\Model\Serializer' => 'src/model/serializers',
        'Levav' => 'src/'
    ]
);

$loader->register();
