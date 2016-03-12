<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%employee}}".
 *
 * @property string $id_employee
 * @property string $name
 * @property string $email
 * @property string $passwd
 * @property integer $active
 * @property string $add_date
 * @property string $upd_date
 * @property string $last_date
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%employee}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'passwd', 'active', 'add_date', 'upd_date'], 'required'],
            [['active'], 'boolean'],
            [['add_date', 'upd_date', 'last_date'], 'date'],
            [['name'], 'string', 'max' => 64],
            [['email'], 'string', 'max' => 128],
            [['passwd'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_employee' => 'Id Employee',
            'name' => '姓名',
            'email' => '邮箱',
            'passwd' => '密码',
            'active' => '状态',
            'add_date' => '注册时间',
            'upd_date' => '更新时间',
            'last_date' => '最后登录',
        ];
    }
}
