<?php

namespace App;

use App\Parking\Parking;

class Repository
{
    protected string $pathToFile;

    public function __construct(string $pathToFile)
    {
        $this->pathToFile = $pathToFile;
    }

    public function getPathToFile(): string
    {
        return $this->pathToFile;
    }

    public function findNextId(): int
    {   
        $id = 0;
        $files = scandir($this->pathToFile);
        foreach ($files as $file) {
            if (!is_dir($file)) {
                $fileContents = file_get_contents($this->pathToFile . '/' . $file);
                $object = unserialize(base64_decode($fileContents));
                $id = max($id, $object->getId());
            }
        }
        return ($id + 1);
    }

    public function addParkingToFile(Parking $parking): void
    {
        $file = '/' . $parking->getId() . '.txt';
        $serializeParking = base64_encode(serialize($parking));
        file_put_contents($this->pathToFile . $file, $serializeParking);
    }

    public function deleteParking(int $id): Parking
    {
        $files = scandir($this->pathToFile);
        foreach ($files as $file) {
            if (!is_dir($file)) {
                $fileContents = file_get_contents($this->pathToFile . '/' . $file);
                $object = unserialize(base64_decode($fileContents));
                if ($object->getId() === $id) {
                    unlink($this->pathToFile . '/' . $file);
                    return $object;
                }
            }
        }
        throw new \DomainException('Парковка с данным id не найдена');
    }

    public function loadParking(int $id): Parking
    {
        $files = scandir($this->pathToFile);
        foreach ($files as $file) {
            if (!is_dir($file)) {
                $fileContents = file_get_contents($this->pathToFile . '/' . $file);
                $object = unserialize(base64_decode($fileContents));
                if ($object->getId() === $id) {
                    return $object;
                }
            }
        }
        throw new \DomainException('Парковка с данным id не найдена');
    }

    public function loadAllParking(): array
    {
        $files = scandir($this->pathToFile);
        $parkings = [];
        foreach ($files as $file) {
            if (!is_dir($file)) {
                $fileContents = file_get_contents($this->pathToFile . '/' . $file);
                $parkings[] = unserialize(base64_decode($fileContents));
            }
        }
        return $parkings;
    }
}
