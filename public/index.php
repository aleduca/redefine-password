<?php

date_default_timezone_set('America/Sao_Paulo');

require '../vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();

$routes = require '../routes/routes.php';

$routes($app);

$app->run();
