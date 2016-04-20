<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\modules\admin\models\Employee;
use yii\console\Controller;
use yii\validators\DateValidator;
use yii;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello world')
    {
        Yii::$app->formatter->locale = 'zh-CH';
        echo Yii::$app->formatter->asDatetime('2014-01-01', 'php:Y-m-d H:i:s');

//        $validate = new DateValidator();
//        $employee = new Employee();
//        $employee->passwd = "123456";
//        echo $employee->setPassword($employee->passwd);
//       $date = date("Y-m-d H:i:s", time());
//        $validate->format = "yyyy-M-d H:m:s";
//       if($validate->validate($date, $error)) {
//           echo $message . "\n";
//       } else {
//           echo $error;
//       }
    }
}
