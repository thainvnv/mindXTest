<?php

namespace App\Http\Service;

use App\Http\Service\BaseService;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PopulationService extends BaseService
{
    public function worldPopulation()
    {
        return $this->request('get', 'worldpopulation');
    }

    public function topTwentyCountryPopulation()
    {
        $result = $this->countriesPopulation();
        return array_slice($result['body']['countries'], 0, 20);
    }

    public function countriesPopulation($isPaginate = false)
    {
        $result =  $this->request('get', 'allcountriesname');
        if($isPaginate){
            return $this->paginate($result['body']['countries']);
        }
       return $result;
    }

    public function countryPopulation($countryName)
    {
        $params = [
            'country_name' => $countryName
        ];
        return $this->request('get', 'population', $params);
    }

}
