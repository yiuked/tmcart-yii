<?php

namespace app\modules\admin\models;

use Yii;
use app\modules\admin\Module;

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
            'id_profile' => Module::t('global', 'id'),
            'name' => Module::t('global', 'name'),
        ];
    }
}
