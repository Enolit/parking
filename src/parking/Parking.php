<?php

namespace App\Parking;

class Parking
{
    protected int $capacity;
    protected int $id;
    protected array $places = [];

    public function __construct(int $capacity, int $id)
    {
        if ($capacity < 1) {
            throw new \DomainException('Number must be more than 0');
        }
        $this->id = $id;
        $this->capacity = $capacity;
    }

    public function park(Vehicle $vehicle): void
    {   
        $available = $this->capacity;
        $places = $this->places;
        foreach ($places as $parkedVehicle) {
            if ($vehicle->getVin() === $parkedVehicle->getVin()) {
                throw new \DomainException('Vehicle with this VIN is already parked');
            }
            $available = $available - $parkedVehicle->getSize();
        }
        
        if ($available < $vehicle->getSize()) {
            throw new \DomainException('There is no space');
        }
        $this->places[] = $vehicle;
    }

    public function unpark(string $vin): void
    {             
        foreach ($this->places as $key => $place) {
            if ($vin === $place->getVin()) {
                unset($this->places[$key]);
                $this->places = array_values($this->places);
                return;
            }
        }
        throw new \DomainException('Сar with this VIN wasn\'t found');
    }

    function getId(): int
    {
        return $this->id;
    }

    function getCapacity(): int
    {
        return $this->capacity;
    }

    function getPlaces(): array
    {
        return $this->places;
    }
}
