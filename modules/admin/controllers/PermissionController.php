<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/12
 * Time: 8:48
 */
namespace app\modules\admin\controllers;

use Yii;
use yii\data\ArrayDataProvider;
use app\modules\admin\components\AdminController;

class PermissionController extends  AdminController
{
    public function actionIndex()
    {
        $auth = Yii::$app->getModule('admin')->authManager;
        $permissions = $auth->getPermissions();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $permissions,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => [ 'createdAt'],
            ],
        ]);
        return $this->render('index',[
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Deletes an existing Employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $auth = Yii::$app->getModule('admin')->authManager;
        $permissionName = Yii::$app->request->get("id");
        $permission = $auth->getPermission($permissionName);
        $auth->remove($permission);

        return $this->redirect(['index']);
    }

    public function actionUpdate()
    {
        $auth = Yii::$app->getModule('admin')->authManager;
        $permissionName = Yii::$app->request->get("id");
        if (!empty($permissionName)) {
            $permission = $auth->getPermission($permissionName);
            if (Yii::$app->request->isPost) {
                $post = Yii::$app->request->post();
                $permission->description = $post['description'];
                if ($auth->update($permissionName, $permission)) {
                    Yii::$app->session->setFlash('PermissionUpdate');
                }
            }
            return $this->render('update', [
                'model' => $permission
            ]);
        }
    }
}