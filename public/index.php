<?php

require '../vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();

$routes = require '../routes/routes.php';

$routes($app);

$app->run();
