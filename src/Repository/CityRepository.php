<?php
namespace App\Repository;

use App\Entity\City;
use App\Exception\City as CustomException;

final class CityRepository extends BaseRepository
{
    public function getAll(string $orderBy = 'id'): array
    {
        return $this->builder
            ->select('*')
            ->from('cities')
            ->orderBy($orderBy, 'ASC')
            ->execute()
            ->fetchAll()
        ;
    }
    
    public function checkAndGetCity(string $cityId): City
    {
        $cityDb = $this->builder
            ->select('*')
            ->from('cities')
            ->where('id = ?')
            ->setParameter(0, $cityId)
            ->execute()
            ->fetch()
        ;
        if (! $cityDb) {
            throw new CustomException('City not found.', 404);
        }

        $city = new City();
        $city->setId($cityDb['id']);
        $city->setName($cityDb['name']);

        return $city;
    }    


}