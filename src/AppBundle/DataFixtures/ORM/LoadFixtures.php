<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 18.06.17
 * Time: 16:00
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class LoadFixtures implements FixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        Fixtures::load(
            __DIR__ . '/fixtures.yml',
            $manager,
            [
                'providers' => [$this]
            ]
        );
    }

    public function currency()
    {
        $genera = [
            'USD',
            'EUR',
            'JPY',
            'GBP',
            'AUD',
            'CAD',
            'CHF',
            'CNY',
            'SEK',
            'NZD'
        ];

        $key = array_rand($genera);

        return $genera[$key];
    }
}