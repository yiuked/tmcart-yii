<?php

namespace app\modules\admin\models;

use Yii;
use yii\validators\Validator;

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
    const NO_UPD_PASSWD = 'no_upd_passwd';
    const  UPD_PASSWD = 'upd_passwd';
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
            [['name', 'id_profile', 'email', 'passwd', 'active', 'add_date', 'upd_date'], 'required'],
            [['id_profile'], 'integer'],
            [['active'], 'boolean'],
            [['add_date', 'upd_date', 'last_date'], 'date', 'format' => "yyyy-M-d H:m:s"],
            [['name'], 'string', 'min' => 3, 'max' => 64],
            [['email'], 'email'],
            [['email'], 'unique'],
            ['passwd', 'string', 'min' => 6,'max' => 32],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['no_upd_passwd'] = ['name', 'id_profile', 'email', 'active', 'add_date', 'upd_date', 'last_date'];
        $scenarios['upd_passwd']    = ['name', 'id_profile', 'email', 'passwd', 'active', 'add_date', 'upd_date', 'last_date'];
        $this->scenario = $this->scenario == self::UPD_PASSWD ? self::UPD_PASSWD : self::NO_UPD_PASSWD;
        return $scenarios;
    }

    public function beforeValidate()
    {
        if (strpos(get_class($this), 'EmployeeSearch') == false) {
            $validate = new Validator();
            if ($validate->isEmpty($this->add_date)) {
                $this->add_date = date("Y-m-d H:i:s", time());
            }
            $this->upd_date = date("Y-m-d H:i:s", time());
            $this->last_date = date("Y-m-d H:i:s", time());
        }

        return parent::beforeValidate();
    }

    public function afterValidate()
    {
 
        if (strpos(get_class($this), 'EmployeeSearch') === false) {
            if ($this->getIsNewRecord() || $this->scenario == self::UPD_PASSWD) {
                $this->passwd = Yii::$app->getSecurity()->generatePasswordHash($this->passwd);
            }
        }
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id_profile' => 'id_profile']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_employee' => 'ID',
            'name' => '姓名',
            'id_profile' => '类型',
            'profile.name' => '类型',
            'email' => '邮箱',
            'passwd' => '密码',
            'active' => '状态',
            'passwd_conf' => '确认密码',
            'add_date' => '注册时间',
            'upd_date' => '更新时间',
            'last_date' => '最后登录',
        ];
    }
}
