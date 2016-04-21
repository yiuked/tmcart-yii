<?php

namespace app\modules\admin\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%tabs}}".
 *
 * @property integer $id_tab
 * @property integer $id_parent
 * @property string $type
 * @property string $icon_class
 * @property string $icon_img
 * @property string $name
 * @property string $url
 * @property integer $active
 */
class Tabs extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tabs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_parent', 'type', 'name', 'active'], 'required'],
            [['id_parent', 'active'], 'integer'],
            [['icon_class', 'icon_img', 'name'], 'string', 'max' => 64],
            [['route'], 'string', 'max' => 128],
        ];
    }
    
    public static function getTabs()
    {
        $result = Tabs::find()
            ->select(['id_tab', 'id_parent', 'icon_class', 'icon_img', 'name', 'route'])
            ->where(['active' => 1])
            ->orderBy('position ASC')
            ->asArray()
            ->all();

        $resultParents = array();
        $resultIds = array();

        foreach ($result as &$row)
        {
            $resultParents[$row['id_parent']][] = &$row;
            $resultIds[$row['id_tab']] = &$row;
        }

        $blockCategTree =self::getTree($resultParents, $resultIds, 1);
        unset($resultParents, $resultIds);

        return $blockCategTree;
    }

    protected static function getTree($resultParents, $resultIds, $id_tab = null)
    {
        $children = array();
        if (isset($resultParents[$id_tab]) && count($resultParents[$id_tab]))
            foreach ($resultParents[$id_tab] as $subcat)
                $children[] = self::getTree($resultParents, $resultIds, $subcat['id_tab']);
        if (!isset($resultIds[$id_tab]))
            return false;
        $return = [
            'id' => $id_tab,
            'route' => $resultIds[$id_tab]['route'],
            'icon_class' => $resultIds[$id_tab]['icon_class'],
            'name' => $resultIds[$id_tab]['name']
        ];
        if (count($children) > 0) {
            $return['children'] = $children;
        }
        return $return;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tab' => Yii::t('app', 'Id Tab'),
            'id_parent' => Yii::t('app', 'Id Parent'),
            'icon_class' => Yii::t('app', 'Icon Class'),
            'icon_img' => Yii::t('app', 'Icon Img'),
            'name' => Yii::t('app', 'Name'),
            'route' => Yii::t('app', 'Url'),
            'active' => Yii::t('app', 'Active'),
        ];
    }
}
