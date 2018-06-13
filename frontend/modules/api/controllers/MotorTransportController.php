<?php
/**
 * Created by PhpStorm.
 * User: mecha
 * Date: 13.06.2018
 * Time: 10:23
 */

namespace frontend\modules\api\controllers;

use common\models\Token;
use frontend\modules\api\models\ApiMotorTransport;
use Yii;
use yii\base\Controller;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class MotorTransportController extends DefaultController {

    public function actionAdd(){
        $model = new ApiMotorTransport();

        $apiMotor["ApiMotorTransport"] = Yii::$app->request->post();

        $model->load($apiMotor);
        $model->status = Constants::STATUS_ENABLED;
        $model->dt_add = time();

        if ( ! $model->save() ) {
            return ActiveForm::validate( $model );
        }

        return "Успешно добавлен";
    }

    public function actionDel(){
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
        $models = ApiMotorTransport::find()->where(['user_id'=>$modelPost->user_id])->asArray()->one();

        return $models;
    }

}