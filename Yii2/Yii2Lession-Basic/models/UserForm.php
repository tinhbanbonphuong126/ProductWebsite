<?php
/**
 * Created by PhpStorm.
 * User: QUE
 * Date: 4/6/2017
 * Time: 11:27 PM
 */

namespace app\models;

use yii\base\Model;

class UserForm extends Model
{
    public $name;
    public $email;

    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email'],
        ];
    }
}