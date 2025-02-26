<?php

declare(strict_types=1);

namespace console\services;

use common\models\ConstructionSite;
use common\models\Employee;
use common\models\WorkItem;
use Exception;
use Faker\Factory;
use Faker\Generator;
use yii\db\ActiveRecord;

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

    /**
     * @throws Exception
     */
    public function seed(): void
    {
        $this->seedConstructionSites();
        $this->seedEmployees();
        $this->seedWorkItems();
    }

    /**
     * @throws Exception
     */
    public function seedConstructionSites(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $site = new ConstructionSite();
            $site->name = $this->faker->company;
            $site->location = $this->faker->address;
            $site->area = $this->faker->randomFloat(2);
            $site->access = $this->getRandomAccessLevel();

            $this->save($site);
        }
    }

    /**
     * @throws Exception
     */
    public function seedEmployees(): void
    {
        for ($i = 0; $i < 20; $i++) {
            $employee = new Employee();
            $employee->name = $this->faker->firstName;
            $employee->surname = $this->faker->lastName;
            $employee->birthdate = $this->faker->date('Y-m-d');
            $employee->access = $this->getRandomAccessLevel();
            $employee->role = $this->faker->randomElement([1, 2, 3]);

            $this->save($employee);
        }
    }

    public function seedWorkItems(): void
    {
        for ($i = 0; $i < 42; $i++) {
            $item = new WorkItem();
            $item->name = $this->faker->sentence(5, true);
            $item->description = $this->faker->sentences(20, true);
            $item->construction_site_id = ConstructionSite::find()
                ->select('id')
                ->orderBy('NEWID()')
                ->limit(1)
                ->scalar();
            $item->employee_id = Employee::find()
                ->select('id')
                ->orderBy('NEWID()')
                ->limit(1)
                ->scalar();

            $this->save($item);
        }
    }

    private function getRandomAccessLevel(): int
    {
        return $this->faker->randomElement([1, 2, 3]);
    }

    /**
     * @throws Exception
     */
    private function save(ActiveRecord $record): void
    {
        if (!$record->save()) {
            throw new Exception(sprintf(
                'Failed to save %s model: %s',
                $record::class,
                var_export($record->getErrors(), true),
            ));
        }
    }
}