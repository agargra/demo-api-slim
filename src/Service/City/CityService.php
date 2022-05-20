<?php
namespace App\Service\City;

use App\Entity\City;

final class CityService extends Base
{
    public function getAll(string $orderBy = 'id'): array
    {
        $orderBy = self::validateCityOrderBy($orderBy);
        return $this->getCityRepository()->getAll($orderBy);
    }

    public function getOne(string $cityId): object
    {
        if (self::isRedisEnabled() === true) {
            $city = $this->getCityFromCache($cityId);
        } else {
            $city = $this->getCityFromDb($cityId)->toJson();
        }
        return $city;
    }

}