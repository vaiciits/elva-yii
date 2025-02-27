<?php

declare(strict_types=1);

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

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
class Employee extends \yii\db\ActiveRecord implements IdentityInterface
{
    final public const int ROLE_ADMIN = 1;
    final public const int ROLE_MANAGER = 2;
    final public const int ROLE_EMPLOYEE = 3;

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

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function getFullName(): string
    {
        return implode(' ', [$this->name, $this->surname]);
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }
}