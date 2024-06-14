<?php

namespace App\Parking;

use App\Api;
use App\Repository;

require_once __DIR__ . '/../vendor/autoload.php';

$repository = new Repository('../data/');

$api = new Api($repository);

$parking1 = $api->loadParking(4);
$parking2 = $api->loadAllParking();


var_dump($parking2->response());



