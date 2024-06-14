<?php

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

$parking = new Parking(5);

$car1 = new Car;
$car2 = new Car;

var_dump($parking->park($car1));
var_dump($parking->park($car2));
var_dump($parking->park($car1));
var_dump($parking->park($car1));
var_dump($parking->park($car1));
var_dump($parking->park($car1));
