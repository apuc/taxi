<?php
/**
 * Created by PhpStorm.
 * User: mecha
 * Date: 13.06.2018
 * Time: 10:23
 */

namespace frontend\modules\api\controllers;

use common\helpers\Constants;
use common\helpers\Folder;
use frontend\modules\api\models\ApiMotorTransport;
use Yii;
use yii\widgets\ActiveForm;

class MotorTransportController extends DefaultController {

    private function SaveImg($img) {
        $dir = '/media/upload/' . Yii::$app->request->post()["user_id"] . '/' . date('Y-m-d') . '/';
        $path = Yii::getAlias('@frontend/web' . $dir);
        $folderCreate = new Folder($path, 0775);
        $folderCreate->create();

        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $name = uniqid() . '.png';
        $file = $path . $name;
        // return $file;
        $success = file_put_contents($file, $data);

//        $folderImg = new Folder($path, 0775);
//        $folderImg->create()
//            ->file($data)
//            ->save($name);
        return $dir . $name;
    }


    public function actionAdd() {
        $model = new ApiMotorTransport();

        $apiMotor["ApiMotorTransport"] = Yii::$app->request->post();

        $model->load($apiMotor);
        if ($model->photo)
            $model->photo = $this->SaveImg($model->photo);
        $model->status = Constants::STATUS_ENABLED;
        $model->dt_add = time();

        if (!$model->save()) {
            return ActiveForm::validate($model);
        }

        return $this->getResult("Транспорт успешно добавлен");
    }

    public function actionDelete() {
        $id = Yii::$app->request->post()["id"];
        $model = ApiMotorTransport::findOne($id);
        if (!is_null($model)) {
            $model->delete();
        }
        return $this->getResult("Транспорт успешно удален!");
    }

    public function actionGet()
    {
        $id = Yii::$app->request->post()["id"];
        $model = ApiMotorTransport::findOne($id);

        if (is_null($model)) {
            return $this->getResult("Транспорт не найден!", Constants::STATUS_DISABLED);
        }

        return $model->toArray();
    }


    public function actionEdit() {
        $id = Yii::$app->request->post()["id"];
        $model = ApiMotorTransport::findOne($id);

        if (is_null($model)) {
            return $this->getResult("Транспорт не найден!", Constants::STATUS_DISABLED);
        }

        $apiMotor["ApiMotorTransport"] = Yii::$app->request->post();

        if(isset(Yii::$app->request->post()['photo'])){
            //var_dump(Yii::$app->request->post()['photo']);die();
            $path = Yii::getAlias('@frontend/web' . $model->photo);
            if($model->photo)
                unlink($path);
        }

        $model->load($apiMotor);

        if ($model->photo) {
            $model->photo = $this->SaveImg($model->photo);
        }
        $model->dt_add = time();

        if (!$model->save()) {
            return ActiveForm::validate($model);
        }

        return $model->toArray();
    }

    public function actionGetLists() {
        $modelPost = new ApiMotorTransport();

        $apiMotor["ApiMotorTransport"] = Yii::$app->request->post();

        $modelPost->load($apiMotor);
        $modelPost->validate();
//        $models = ApiMotorTransport::find()->where(['user_id' => $modelPost->user_id])->asArray()->all();


        if (is_null($modelPost->user_id)) {
            $models = ApiMotorTransport::find()->limit($modelPost->limit)->offset($modelPost->offset)
                ->asArray()->all();
        } else {
            $models = ApiMotorTransport::find()->where(['user_id'=> (int)$modelPost->user_id])
                ->limit($modelPost->limit)->offset($modelPost->offset)
                ->asArray()->all();
        }

        return $models;
    }


}