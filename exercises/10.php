<?php

namespace App\Parking;

use App\Api;
use App\Repository;

require_once __DIR__ . '/../vendor/autoload.php';

$repository = new Repository('../data/');

$api = new Api($repository);

$parking = $api->parkVehicle(3, "DHNYHJ46543FGSE44", 'bike');
$parking = $api->unparkVehicle(3, "DHNYHJ46543FGSE44");
$parking1 = $api->loadParking(3);
$allParking = $api->loadAllParking();
$deleted = $api->deleteParking(2);
