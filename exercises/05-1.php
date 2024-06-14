<?php

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

$parking = new Parking(5);

$car1 = new Car;
$car2 = new Car;

$parking->park($car1);
$parking->park($car2);
