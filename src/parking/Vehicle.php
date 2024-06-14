<?php

namespace App\Parking;

abstract class Vehicle
{
    protected string $vin;
    protected const SIZE = null;    

    public function __construct(string $vin)
    {               
        if (strlen($vin) !== 17) {
            throw new \DomainException('VIN must have 17 signs');
        }
        $this->vin = $vin;       
    }   

    public function getVin(): string
    {
        return $this->vin;
    }
    public function getSize(): float
    {
        if (static::SIZE === null) {
            throw new \DomainException('There is no size of vehicle');
        }
        return (float) static::SIZE;
    }

}