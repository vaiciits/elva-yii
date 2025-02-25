<?php

declare(strict_types=1);

namespace common\models;

use Yii;

/**
 * This is the model class for table "EMPLOYEE".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $surname
 * @property string|null $birthdate
 * @property int|null $access
 * @property int|null $role 1 - admin; 2 - manager; 3 - em
 *
 * @property WorkItem[] $workItems
 */
class Employee extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'EMPLOYEE';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'birthdate', 'access', 'role'], 'default', 'value' => null],
            [['birthdate'], 'safe'],
            [['access', 'role'], 'integer'],
            [['name', 'surname'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'birthdate' => 'Birthdate',
            'access' => 'Access',
            'role' => 'Role',
        ];
    }

    /**
     * Gets query for [[WORKITEMs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkItems()
    {
        return $this->hasMany(WorkItem::class, ['employee_id' => 'id']);
    }
}