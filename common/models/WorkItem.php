<?php

declare(strict_types=1);

namespace common\models;

use Yii;

/**
 * This is the model class for table "WORK_ITEM".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $construction_site_id
 * @property int|null $employee_id
 *
 * @property ConstructionSite $constructionSite
 * @property Employee $employee
 */
class WorkItem extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'WORK_ITEM';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'construction_site_id', 'employee_id'], 'default', 'value' => null],
            [['description'], 'string'],
            [['construction_site_id', 'employee_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::class, 'targetAttribute' => ['employee_id' => 'id']],
            [['construction_site_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConstructionSite::class, 'targetAttribute' => ['construction_site_id' => 'id']],
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
            'description' => 'Description',
            'construction_site_id' => 'Construction Site',
            'employee_id' => 'Employee',
        ];
    }

    /**
     * Gets query for [[ConstructionSite]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConstructionSite()
    {
        return $this->hasOne(ConstructionSite::class, ['id' => 'construction_site_id']);
    }

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::class, ['id' => 'employee_id']);
    }
}