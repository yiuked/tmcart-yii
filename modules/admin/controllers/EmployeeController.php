<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Employee;
use app\modules\admin\models\EmployeeSearch;
use app\modules\admin\models\Profile;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if (isset($post['id_employee'])) {
                if (Employee::deleteAll('id_employee IN(' . implode(',', $post['id_employee']) . ')')) {
                    Yii::$app->session->setFlash('conf', '已成功删除用户！');
                }else{
                    Yii::$app->session->setFlash('error', '删除用户失败！');
                }
            }
        }
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $profiles       = Profile::find()->all();
        $profileData    = ArrayHelper::map($profiles,'id_profile','name');
        return $this->render('index', [
            'profileData' => $profileData,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Employee();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_employee]);
        } else {
            $profiles       = Profile::find()->all();
            $profileData    = ArrayHelper::map($profiles,'id_profile','name');
            return $this->render('create', [
                'profileData' => $profileData,
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Employee::NO_UPD_PASSWD;
        $old_hash_passwd = $model->passwd;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->passwd != $old_hash_passwd) {
                $model->scenario = Employee::UPD_PASSWD;
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id_employee]);
            }
        }
        $profiles       = Profile::find()->all();
        $profileData    = ArrayHelper::map($profiles,'id_profile','name');
        return $this->render('update', [
            'profileData' => $profileData,
            'model' => $model,
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
