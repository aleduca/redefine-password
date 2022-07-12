<?php

function view(string $view, array $data = [])
{
    $templates = new League\Plates\Engine(dirname(__FILE__, 3) . '/views');

    echo $templates->render($view, $data);
}
