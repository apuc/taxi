<?php

namespace backend\controllers;

use backend\models\MotorTransport;
use backend\models\User;
use common\helpers\Constants;
use Yii;
use backend\models\MotorTransportSearch;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MotorTransportController implements the CRUD actions for MotorTransport model.
 */
class MotorTransportController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all MotorTransport models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MotorTransportSearch();
        $users = User::find()->all();
        $searchModel->load($users);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users' => $users,
        ]);
    }

    /**
     * Displays a single MotorTransport model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MotorTransport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MotorTransport();
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->user_id = Yii::$app->user->id;
            $model->status = Constants::STATUS_ENABLED;
            $model->dt_add = time();
            $this->saveImage($model);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MotorTransport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $this->saveImage($model);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MotorTransport model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MotorTransport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MotorTransport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MotorTransport::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function saveImage(MotorTransport $model)
    {

        $dir = '/media/upload/' . Yii::$app->user->id . '/' . date('Y-m-d') . '/';
        $path = Yii::getAlias('@frontend/web' . $dir);
        if (!file_exists(Yii::getAlias('@frontend/web') . '/media/upload/' . Yii::$app->user->id . '/' . date('Y-m-d'))) {
            FileHelper::createDirectory($path);
        }

        $photo = UploadedFile::getInstance($model, "file");

        if ($photo) {
            $model->photo = $photo;
            $imgFile = $path . md5($model->photo->baseName) . "." . $model->photo->extension;
            $model->photo->saveAs($imgFile);
            $model->photo = $dir . md5($model->photo->baseName) . "." . $model->photo->extension;
        }
    }
}
