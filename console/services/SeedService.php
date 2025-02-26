<?php

declare(strict_types=1);

namespace console\services;

use common\models\ConstructionSite;
use Exception;
use Faker\Factory;
use Faker\Generator;

/**
 * Data seeder for db.
 */
class SeedService
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function seed(): void
    {
        $this->seedConstructionSites();
    }

    public function seedConstructionSites(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $site = new ConstructionSite();
            $site->name = $this->faker->company;
            $site->location = $this->faker->address;
            $site->area = $this->faker->randomFloat(2);
            $site->access = $this->faker->randomElement([1, 2, 3]);

            if (!$site->save()) {
                throw new Exception(var_export($site->getErrors(), true));
            }
        }
    }
}