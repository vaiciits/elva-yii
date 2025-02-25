<?php

declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%CONSTRUCTION_SITE}}`.
 */
class m250225_191321_create_construction_site_table extends Migration
{
    public const string TABLE = '{{%CONSTRUCTION_SITE}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'name' => $this->string(300),
            'location' => $this->string(100),
            'area' => $this->float(3),
            'access' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
}