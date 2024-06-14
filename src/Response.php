<?php

namespace App;

use App\Parking\Parking;

class Response
{
    protected Parking|array $parking;

    public function __construct(Parking|array $parking)
    {
        $this->parking = $parking;
    }

    public function response(): array
    {
        if (is_array($this->parking)) {
            foreach ($this->parking as $parking) {
                $array =  array(
                    'id' => $parking->getId(),
                    'capacity' => $parking->getCapacity(),
                    'places' => $parking->getPlaces(),
                );
                $resultArray[] = $array;
            }
            return $resultArray;
        } else {
            return [
                'id' => $this->parking->getId(),
                'capacity' => $this->parking->getCapacity(),
                'places' => $this->parking->getPlaces(),
            ];
        }
    }
}
