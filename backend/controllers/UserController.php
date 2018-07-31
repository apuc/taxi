<?php

namespace backend\controllers;

use backend\models\Profile;
use backend\models\User;
use backend\models\UserSearch;
use Yii;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            "profile" => Profile::findOne(["user_id" => $id])
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $profile = Profile::findOne(["user_id" => $id]);

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $profile->load(Yii::$app->request->post());
            $this->saveImage($profile);
            $profile->save();
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            "profile" => $profile
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Profile::findOne(["user_id" => $id])->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function saveImage($model)
    {

        $dir = '/media/upload/' . Yii::$app->user->id . '/' . date('Y-m-d') . '/';
        $path = Yii::getAlias('@frontend/web' . $dir);
        if (!file_exists(Yii::getAlias('@frontend/web') . '/media/upload/' . Yii::$app->user->id . '/' . date('Y-m-d'))) {
            FileHelper::createDirectory($path);
        }

        $photo = UploadedFile::getInstance($model, "file");

        if ($photo) {
            $model->avatar = $photo;
            $imgFile = $path . md5($model->avatar->baseName) . "." . $model->avatar->extension;
            $model->avatar->saveAs($imgFile);
            $model->avatar = $dir . md5($model->avatar->baseName) . "." . $model->avatar->extension;
        }
    }
}
