<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 18.06.17
 * Time: 15:24
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        Fixtures::load(
            __DIR__.'/userFixtures.yml',
            $manager,
            [
                'providers' => [$this]
            ]
        );
    }

    public function currency()
    {
        $genera = [
            'EUR',
            'BGN',
            'BAM',
            'BYR',
            'USD',
            'GBP',
            'GIP',
            'NOK',
            'SEK',
            'HTG'
        ];

        $key = array_rand($genera);

        return $genera[$key];
    }
}