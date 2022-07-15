<?php

namespace app\controllers;

use app\classes\Mailer;
use app\database\Connection;
use DateTime;

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

        $token = md5(uniqid());

        $date = new DateTime();
        $date->modify('+5 minutes');

        // delete reset token
        $sql = 'delete from reset where user_id = :user_id';
        $prepare = $connection->prepare($sql);
        $prepare->execute(['user_id' => $user->id]);

        // insert in reset table
        $sql = 'insert into reset(user_id, time, token) values(:user_id, :time, :token)';
        $prepare = $connection->prepare($sql);
        $prepare->execute([
            'user_id' => $user->id,
            'time' => $date->format('Y-m-d H:i:s'),
            'token' => $token,
        ]);

        $mailer = new Mailer;
        $sent = $mailer->send('aleducardoso@gmail.com', $user->email, $token);

        var_dump($sent);

        die();
    }
}
