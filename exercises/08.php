<?php

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

$api = new Api;

$api->createParking(10);
