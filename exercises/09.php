<?php

namespace App\Parking;
use App\Api;
use App\Repository;

require_once __DIR__ . '/../vendor/autoload.php';

$repository = new Repository('../data/');

$api = new Api($repository);

$parking = $api->createParking(10);
