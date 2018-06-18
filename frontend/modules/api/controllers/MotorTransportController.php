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

        return "Успешно добавлен";
    }

    public function actionDel() {
        $id = Yii::$app->request->post()["id"];
        ApiMotorTransport::deleteAll(['id' => $id]);

        return "Заявка удалена";
    }

    public function actionEdit() {
        $id = Yii::$app->request->post()["id"];
        $model = ApiMotorTransport::findOne($id);

        $apiMotor["ApiMotorTransport"] = Yii::$app->request->post();

        $model->load($apiMotor);

        if ($model->photo) {
            $model->photo = $this->SaveImg($model->photo);
        }
        $model->dt_add = time();

        if (!$model->save()) {
            return 'Ошибка редактирования';
        }

        return $model->toArray();
    }

    public function actionGetLists() {
        $modelPost = new ApiMotorTransport();

        $apiMotor["ApiMotorTransport"] = Yii::$app->request->post();

        $modelPost->load($apiMotor);
        $models = ApiMotorTransport::find()->where(['user_id' => $modelPost->user_id])->asArray()->all();

        return $models;
    }


}