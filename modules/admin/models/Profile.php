<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%profile}}".
 *
 * @property string $id_profile
 * @property string $name
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%profile}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_profile' => Yii::t('app', 'Id Profile'),
            'name' => Yii::t('app', 'Name'),
        ];
    }
}
