<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Mledoze\Countries\Country as MledozeCountry;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pays>
 */
class PaysFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $mledozeCountries = MledozeCountry::getList('fr');
        $mledozeCountriesData = array_map(function ($mledozeCountry) {
            return [
                'code' => $mledozeCountry->getAlpha2(),
                'pays' => $mledozeCountry->getName()
            ];
        }, $mledozeCountries);

        return $mledozeCountriesData;
    }
}
