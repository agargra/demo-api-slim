<?php
namespace App\Service\City;

use App\Entity\City;
use App\Repository\CityRepository;
use App\Service\BaseService;
use App\Service\RedisService;
use App\Exception\City as CustomException;
use Respect\Validation\Validator as v;

abstract class Base extends BaseService
{
    private const REDIS_KEY = 'city:%s';
    
    protected CityRepository $cityRepository;
    protected RedisService $redisService;

    public function __construct(
        CityRepository $cityRepository,
        RedisService $redisService
    ) {
        $this->cityRepository = $cityRepository;
        $this->redisService = $redisService;
    }

    protected function getCityRepository(): CityRepository
    {
        return $this->cityRepository;
    }
    
    protected static function validateCityOrderBy(string $orderBy): string
    {
        $orderByAccepted = ['id', 'name'];
        if (! v::in($orderByAccepted)->validate($orderBy)) {
            throw new CustomException('Invalid orderBy. Try one of these: [' . implode(', ',$orderByAccepted). ']', 400);
        }
        return $orderBy;
    }
    
    protected function getCityFromCache(string $cityId): object
    {
        $redisKey = sprintf(self::REDIS_KEY, $cityId);
        $key = $this->redisService->generateKey($redisKey);
        if ($this->redisService->exists($key)) {
            $city = $this->redisService->get($key);
        } else {
            $city = $this->getCityFromDb($cityId)->toJson();
            $this->redisService->setex($key, $city);
        }
        return $city;
    }

    protected function getCityFromDb(string $cityId): City
    {
        return $this->getCityRepository()->checkAndGetCity($cityId);
    }    

}