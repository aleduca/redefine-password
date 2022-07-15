<?php

namespace app\controllers;

use app\database\Connection;
use DateTime;
use Exception;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class PasswordRedefineController
{
    public function check(Request $request, Response $response, $args)
    {
        try {
            if (!isset($args['token'])) {
                throw new Exception('Can not find token');
            }

            $token = $args['token'];
            $sql = 'select * from reset where token = :token';

            $connection = Connection::getConnection();
            $prepare = $connection->prepare($sql);
            $prepare->execute(['token' => $token]);
            $data = $prepare->fetchObject();

            $expiration = new DateTime($data->time);
            $now = new DateTime('now');

            if ($now >= $expiration) {
                throw new Exception('Token invalid');
            }

            view('redefine_password', ['token' => $token]);

            die();

            return $response;
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            die();
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        $token = $args['token'];
        $password = strip_tags($_POST['password']);
        $sql = 'select * from reset where token = :token';

        $connection = Connection::getConnection();
        $prepare = $connection->prepare($sql);
        $prepare->execute(['token' => $token]);
        $data = $prepare->fetchObject();

        $expiration = new DateTime($data->time);
        $now = new DateTime('now');

        if ($now >= $expiration) {
            throw new Exception('Token invalid');
        }

        $sql = 'update users set password = :password where id = :id';
        $prepare = $connection->prepare($sql);
        $updated = $prepare->execute(['password' => password_hash($password, PASSWORD_DEFAULT), 'id' => $data->user_id]);

        var_dump($updated);

        die();
    }
}
