<?php

namespace wolfguard\config\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * AdminController allows you to administrate configs.
 *
 * @property \wolfguard\config\Module $module
 * @author Ivan Fedyaev <ivan.fedyaev@gmail.com
 */
class AdminController extends Controller
{
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete'  => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        /*'matchCallback' => function ($rule, $action) {
                            return in_array(\Yii::$app->user->identity->username, $this->module->admins);
                        }*/
                    ],
                ]
            ]
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = $this->module->manager->createConfigSearch();
        $dataProvider = $searchModel->search($_GET);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    }

    /**
     * Creates a new Config model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = $this->module->manager->createConfig(['scenario' => 'create']);

        if ($model->load(\Yii::$app->request->post()) && $model->create()) {
            \Yii::$app->getSession()->setFlash('config.success', \Yii::t('config', 'Config has been created'));
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing Config model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param  integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            if(\Yii::$app->request->get('returnUrl')){
                $back = urldecode(\Yii::$app->request->get('returnUrl'));
                return $this->redirect($back);
            }

            \Yii::$app->getSession()->setFlash('config.success', \Yii::t('config', 'Config has been updated'));
            return $this->refresh();
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    /**
     * Deletes an existing Config model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param  integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if(!$model->system) {
            $model->delete();
            \Yii::$app->getSession()->setFlash('config.success', \Yii::t('config', 'Config has been deleted'));
        }else{
            \Yii::$app->getSession()->setFlash('config.error', \Yii::t('config', 'Can\'t delete system configuration value'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Config model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param  integer                    $id
     * @return \wolfguard\config\models\Config the loaded model
     * @throws NotFoundHttpException      if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = $this->module->manager->findConfigById($id);

        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist');
        }

        return $model;
    }
}
