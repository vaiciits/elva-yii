<?php

declare(strict_types=1);

namespace common\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "CONSTRUCTION_SITE".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $location
 * @property float|null $area
 * @property int|null $access
 *
 * @property WorkItem[] $workItems
 * @property Employee[] $employeesWithMissingAccess
 */
class ConstructionSite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CONSTRUCTION_SITE';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'location', 'area', 'access'], 'default', 'value' => null],
            [['area'], 'number'],
            [['access'], 'integer'],
            [['name'], 'string', 'max' => 300],
            [['location'], 'string', 'max' => 100],
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
            'location' => 'Location',
            'area' => 'Area',
            'access' => 'Access',
        ];
    }

    /**
     * Gets query for [[WORKITEMs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkItems(): ActiveQuery
    {
        return $this->hasMany(
            WorkItem::class,
            ['construction_site_id' => 'id'],
        );
    }

    public function getEmployeesWithMissingAccess(): ActiveQuery
    {
        return $this->hasMany(Employee::class, ['id' => 'employee_id'])
            ->viaTable(
                WorkItem::tableName() . ' wi',
                ['construction_site_id' => 'id'],
            )
            ->where(['>', Employee::tableName() . '.access', $this->access]);
    }
}