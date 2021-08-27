<?php

namespace App\Http\Controllers;

use App\Http\Service\PopulationService;
use Illuminate\Http\Request;


class PopulationController extends Controller
{
    private $populationService;

    public function __construct(PopulationService $populationService)
    {
        $this->populationService = $populationService;
    }

    public function worldPopulation()
    {
        $worldPopulation = $this->populationService->worldPopulation();
        $worldPopulation = $worldPopulation['body']['world_population'];

        $topTwentyCountryPopulation = $this->populationService->topTwentyCountryPopulation();
        $countriesPopulation = $this->populationService->countriesPopulation(true);

        return response()->view('dashboard', compact('worldPopulation', 'topTwentyCountryPopulation', 'countriesPopulation'));
    }
}
