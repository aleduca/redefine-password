<?php

namespace app\controllers;

use app\database\Connection;

class EmailVerifyController
{
    public function verify()
    {
        $email = strip_tags($_POST['email']);

        $connection = Connection::getConnection();

        $sql = 'select id,firstName,email from users where email = :email';
        $prepare = $connection->prepare($sql);
        $prepare->execute(['email' => $email]);

        $user = $prepare->fetchObject();

        if (!$user) {
            var_dump('Esse email não está cadastrado em nossa base de dados');
            die();
        }

        var_dump($user);

        die();
    }
}
