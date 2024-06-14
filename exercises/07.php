<?php

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

$parking = new Parking(5);

$vehicle1 = new Car('DHNYHJ46543FGSE44');
$vehicle2 = new Bike('DH643346543FGSE44');
$vehicle3 = new Truck('ERNYHJ46543FGSE44');
$vehicle4 = new Truck('ERNYHJ46543FG4E44');
$vehicle5 = new Bike('DH643346543EGSE44');

$parking->park($vehicle1);
$parking->park($vehicle2);
$parking->park($vehicle3);
