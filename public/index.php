<?php

use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Url;
use Phalcon\Di\FactoryDefault;


$di = new FactoryDefault();

$di->set('url', function() {
  $url = new Url();
  $url->setBaseUri('/api');

  return $url;
});

$app = new Micro($di);

$app->get(
  '/members',
  function () {
    echo("home");
  }
);


$app->notFound(function () use ($app) {
  echo 'Not found.';
});

$app->handle();
