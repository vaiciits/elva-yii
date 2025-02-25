<?php

declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%EMPLOYEE}}`.
 */
class m250225_190228_create_employee_table extends Migration
{
    public const string TABLE = '{{%EMPLOYEE}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'name' => $this->string(50),
            'surname' => $this->string(50),
            'birthdate' => $this->date('Y-m-d'),
            'access' => $this->integer(),
            'role' => $this->integer(),
        ]);

        $this->addCommentOnColumn(
            self::TABLE,
            'role',
            '1 - admin; 2 - manager; 3 - employee',
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