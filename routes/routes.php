<?php

use app\controllers\EmailVerifyController;
use app\controllers\HomeController;
use app\controllers\PasswordRedefineController;

return function ($app) {
    $app->get('/', [HomeController::class, 'index']);
    $app->post('/email/verify', [EmailVerifyController::class, 'verify']);
    $app->get('/password/redefine/{token}', [PasswordRedefineController::class, 'check']);
    $app->post('/password/update/{token}', [PasswordRedefineController::class, 'update']);
};
