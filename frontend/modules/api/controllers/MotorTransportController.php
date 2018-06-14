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
use common\models\Token;
use frontend\modules\api\models\ApiMotorTransport;
use Yii;
use yii\base\Controller;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class MotorTransportController extends DefaultController {

    private function SaveImg($img) {
        $dir = '/media/upload/' . Yii::$app->user->id . '/' . date('Y-m-d') . '/';
        $path = Yii::getAlias('@frontend/web' . $dir);
        $folderThumb = new Folder($path, 0775);
        $folderThumb->create();

//        $image_parts = explode(";base64,", $img);
//        $image_type_aux = explode("image/", $image_parts[0]);
//        $image_type = $image_type_aux[1];
//        $image_base64 = base64_decode($image_parts[1]);
//        $file = $path . uniqid() . '.png';
//        //file_put_contents($file, $image_base64);
//
//        $folderImg = new Folder($path, 0775);
//        $folderImg->create()
//            ->file($image_base64)
//            ->save($file);
    }


    public function actionAdd() {
        $model = new ApiMotorTransport();

        $apiMotor["ApiMotorTransport"] = Yii::$app->request->post();

        $model->load($apiMotor);
        return $this->SaveImg($model->photo);
        $model->status = Constants::STATUS_ENABLED;
        $model->dt_add = time();

        if (!$model->save()) {
            return ActiveForm::validate($model);
        }

        return "Успешно добавлен";
    }

    public function actionDel() {
        $id = Yii::$app->request->post()["id"];
        ApiMotorTransport::deleteAll($id);

        return "Заявка удалена";
    }

    public function actionEdit() {
        $id = Yii::$app->request->post()["id"];
        $model = ApiMotorTransport::findOne($id);

        if (is_null($model)) {
            return "None";
        }

        return $model->toArray();
    }

    public function actionGetLists() {
        $modelPost = new ApiMotorTransport();

        $apiMotor["ApiMotorTransport"] = Yii::$app->request->post();

        $modelPost->load($apiMotor);
        $models = ApiMotorTransport::find()->where(['user_id' => $modelPost->user_id])->asArray()->one();

        return $models;
    }


}