<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $employee_id;

    private $employee;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id',], 'required'],
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getEmployee(), 3600 * 24 * 30);
        }

        return false;
    }

    /**
     * Finds employee by id.
     *
     * @return Employee|null
     */
    protected function getEmployee()
    {
        if ($this->employee === null) {
            $this->employee = Employee::findOne($this->employee_id);
        }

        return $this->employee;
    }
}