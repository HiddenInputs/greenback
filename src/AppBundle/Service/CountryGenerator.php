<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 16.06.17
 * Time: 22:42
 */

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
        $countryNameList = [];

        foreach ($this->getCountryList() as $country) {
            $countryNameList[] = $country['name']['common'];
        }

        return $countryNameList;
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

        return $this->countryData = array_merge($europe,$northAmerica);
    }

}