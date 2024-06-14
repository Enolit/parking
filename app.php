<?php

namespace App;

require_once __DIR__ . '/vendor/autoload.php';

$repository = new Repository('data/');
$api = new Api($repository);

$methodName = $argv[1];
$args = array_slice($argv, 2);

try {
    $apiResponse = $api->$methodName(...$args);
    $response = $apiResponse->response();
    var_dump(json_encode($response));
} catch (\Throwable $e) {
    echo $e;
}
