<?php

namespace AppBundle\Service;

use Rinvex\Country\Loader;

class CountryGenerator
{
    /**
     * @var array
     */
    private $countryData;

    /**
     * @return array
     */
    public function getCountryNames(): array
    {
        $countryNameList = $countryISOList = [];

        foreach ($this->getCountryList() as $countryIndex => $country) {
            $countryNameList[] = $country['name']['common'];
            $countryISOList[] = [
                'iso' => $countryIndex
            ];
        }

        return ['countries' => $countryNameList, 'iso' => $countryISOList];
    }

    /**
     * @return array
     */
    public function getCurrencies(): array
    {
        $countryCurrencyList = [];

        foreach ($this->getCountryList() as $country) {
            $countryCurrencyList[] = $country['currency'][key($country['currency'])]['iso_4217_code'];
        }

        return $countryCurrencyList;
    }

    /*
     * @return array
     */
    private function getCountryList(): array
    {
        if (!empty($this->countryData)) {
            return $this->countryData;
        }

        $northAmerica = Loader::where('geo.continent', ['NA' => 'North America']);
        $europe = Loader::where('geo.continent', ['EU' => 'Europe']);

        return $this->countryData = array_merge($europe, $northAmerica);
    }

}