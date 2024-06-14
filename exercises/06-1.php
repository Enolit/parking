<?php

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

$parking = new Parking(5);

$car1 = new Car('DHNYHJ46543FGSE77');
$car2 = new Car('DHNYHJ4HDRU364577');
$car3 = new Car('STY5678JYJU364555');

$parking->park($car1);
$parking->park($car2);
$parking->park($car3);

$parking->unpark('DHNYHJ4HDRU364577');
$parking->unpark('DHNYHJ46543FGSE77');
