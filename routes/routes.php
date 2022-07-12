<?php

use app\controllers\EmailVerifyController;
use app\controllers\HomeController;

return function ($app) {
    $app->get('/', [HomeController::class, 'index']);
    $app->post('/email/verify', [EmailVerifyController::class, 'verify']);
};
