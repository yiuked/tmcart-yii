<?php
/**
 * 2016/4/11 Yiuked
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade to newer
 * versions in the future.
 *
 * @author    Yiuked SA <yiuked@vip.qq.com>
 * @copyright 2010-2015 Yiuked
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

namespace app\components\widgets;

use yii;
use yii\bootstrap\Widget;
use yii\helpers\Url;
use yii\helpers\Html;

class SideBar extends Widget
{
    const SIDEBAR_IS_MAIN = 'IS_MAIN';
    const SIDEBAR_IS_MENU_TITLE = 'IS_MENU_TITLE';
    const SIDEBAR_IS_MENU = 'IS_MENU';
    const SIDEBAR_IS_OTHER = 'IS_OTHER';

    public $items = [];
    public $type;
    public $options;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        if (empty($this->items)) {
            return;
        }
        $items = [];
        foreach ($this->items as $item) {
            $items[] = $this->renderItem($item);
        }
        return Html::tag('ul', implode('', $items), $this->options);
    }

    public static function getCurrentMainMenu($tabs = [])
    {
        if (count($tabs) > 0) {
            $currentRoute = Yii::$app->controller->getRoute();
            foreach ($tabs as $tab) {
                if ($currentRoute == $tab['route']) {
                    return $tab;
                }
            }
        }
    }

    /**
     * 生成菜单项
     * @param array $item 菜单栏参数[url=>xx, icon_class=>xxx, name=>xxx].
     * @return string 生成的HTML代码
     */
    protected function renderItem($item)
    {
        $url = Url::toRoute([
            '/' . $item['route']
        ]);
        if ($this->type == self::SIDEBAR_IS_MAIN) {
        return '<li class="nav-item'. (isset($item['is_active']) ? ' active' : '') .'">
            <a class="sidebar-trans" href="' . $url . '">
                <div class="nav-icon sidebar-trans"><span aria-hidden="true" class="' . $item['icon_class'] . '"></span></div>
                <span class="nav-title ng-binding">' . $item['name'] . '</span>
            </a>
        </li>';
        } elseif ($this->type == self::SIDEBAR_IS_MENU) {
            return '<li'. (isset($item['is_active']) ? ' class="active"' : '') .'>
            <a href="' . $url . '">' . $item['name'] . '</a>
        </li>';
        }
    }
    
    public static function initSideBarData($items = [])
    {
        if (!is_array($items)) {
            return;
        }

        $currentRoute = Yii::$app->controller->getRoute();
        foreach ($items as &$item) {
            if ($item['route'] == $currentRoute) {
                $item['is_active'] = true;
            }
            if (isset($item['children'])) {
                foreach ($item['children'] as &$node) {
                    if ($currentRoute == $node['route']) {
                        $item['is_active'] = true;
                        $node['is_active'] = true;
                    }
                }
            }
        }
        return $items;
    }
    
    public static function getSideBarMenuData($items = [])
    {
        if (!is_array($items)) {
            return;
        }
        
        foreach ($items as $item) {
            if (isset($item['is_active'])) {
                return $item;
            }
        }
        return false;       
    }
}