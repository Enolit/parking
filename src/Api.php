<?php

namespace App;

use App\Parking\Parking;

class Api
{
    protected Repository $repository;
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function createParking(int $capacity): Response
    {
        try {
            $id = $this->repository->findNextId();
            $newParking = new Parking($capacity, $id);
            $this->repository->addParkingToFile($newParking);
            $response = new Response($newParking);
            return $response;
        } catch (\DomainException $e) {
            throw new ApiException(
                'Произошла ошибка: ' . $e->getMessage(),
                0,
                $e
            );
        }
    }

    public function loadParking(int $id): Response
    {
        try {
            $response = new Response($this->repository->loadParking($id));
            return $response;
        } catch (\DomainException $e) {
            throw new ApiException(
                'Произошла ошибка: ' . $e->getMessage(),
                0,
                $e
            );
        }
    }

    public function loadAllParking(): Response
    {
        try {
            $response = new Response($this->repository->loadAllParking());
            return $response;
        } catch (\DomainException $e) {
            throw new ApiException(
                'Произошла ошибка: ' . $e->getMessage(),
                0,
                $e
            );
        }
    }

    public function deleteParking(int $id): Response
    {
        try {
            $parking = $this->repository->deleteParking($id);
            $response = new Response($parking);
            return $response;
        } catch (\DomainException $e) {
            throw new ApiException(
                'Произошла ошибка: ' . $e->getMessage(),
                0,
                $e
            );
        }
    }

    public function parkVehicle(int $id, string $vin, string $type): Response
    {
        $type = ucfirst($type);
        $class = 'App\\Parking\\' . $type;
        if (class_exists($class) && is_subclass_of($class, 'App\\Parking\\Vehicle')) {
            $vehicle = new $class($vin);
        } else {
            throw new ApiException('Wrong type. Available types: Bike, Car, Truck');
        }

        try {
            $parking = $this->repository->loadParking($id);
            $parking->park($vehicle);
            $this->repository->addParkingToFile($parking);
            $response = new Response($parking);
            return $response;
        } catch (\DomainException $e) {
            throw new ApiException(
                'Произошла ошибка: ' . $e->getMessage(),
                0,
                $e
            );
        }
    }

    public function unparkVehicle(int $id, string $vin): Response
    {
        try {
            $parking = $this->repository->loadParking($id);
            $parking->unpark($vin);
            $this->repository->addParkingToFile($parking);
            $response = new Response($parking);
            return $response;
        } catch (\DomainException $e) {
            throw new ApiException(
                'Произошла ошибка: ' . $e->getMessage(),
                0,
                $e
            );
        }
    }
}
