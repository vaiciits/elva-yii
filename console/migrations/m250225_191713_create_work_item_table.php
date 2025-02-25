<?php

declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%work_item}}`.
 */
class m250225_191713_create_work_item_table extends Migration
{
    public const string TABLE = '{{%WORK_ITEM}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'name' => $this->string(100),
            'description' => $this->text(),
            'construction_site_id' => $this->integer()->null(),
            'employee_id' => $this->integer()->null(),
        ]);

        $this->addForeignKey(
            'fk-work_item-construction_site_id',
            self::TABLE,
            'construction_site_id',
            'CONSTRUCTION_SITE',
            'id',
        );

        $this->addForeignKey(
            'fk-work_item-employee_id',
            self::TABLE,
            'employee_id',
            'EMPLOYEE',
            'id',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
}