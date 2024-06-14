<?php

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

$parking = new Parking(5);

$car1 = new Car('DHNYHJ46543FGSE44');
$car2 = new Car('DHNYHJ46543FGSE44');

$parking->park($car1);
$parking->park($car2);
