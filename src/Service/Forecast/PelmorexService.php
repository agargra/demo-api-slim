<?php
namespace App\Service\Forecast;

use App\Exception\Forecast as CustomException;

final class PelmorexService extends Base
{
    private string $baseURL = "https://weatherapi.pelmorex.com/v1";
    
    public function getTemperaturesByCity(string $cityId, int $numDays = 5): array
    {
        $endpoint = sprintf("/longterm/eltiempo/placecode/%s",$cityId);
        $response = $this->getHttpClient()->request('GET', $this->baseURL.$endpoint, ['verify' => false]);
        if ($response->getStatusCode() != 200){
            throw new CustomException($response->getReasonPhrase(), $response->getStatusCode());
        }
        
        $temperatures = [];
        
        $data = json_decode($response->getBody(), false);
        if (is_array($data->longterm)){
            for ($i=0;$i<count($data->longterm);$i++){
                
                if ( ($i+1) > $numDays ) break;

                $info = new \stdClass();
                $info->datetime = $data->longterm[$i]->timeLocal;
                $info->min = $data->longterm[$i]->temperatureMin->value;
                $info->max = $data->longterm[$i]->temperatureMax->value;
                $temperatures[] = $info;
            }
        }

        return $temperatures;
    }


}