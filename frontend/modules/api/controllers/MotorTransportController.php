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
use yii\base\Controller;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class MotorTransportController extends DefaultController {

    public function actionAdd(){
        $apiMotor["ApiMotorTransport"] = Yii::$app->request->post();

        $model = new ApiMotorTransport();

        $model->load($apiMotor);
        $model->status = Constants::STATUS_ENABLED;
        $model->dt_add = time();

        if ( ! $model->save() ) {
            return ActiveForm::validate( $model );
        }

        return "Успешно добавлен";
    }

    public function actionDel(){
        $model = new ApiMotorTransport();

        $model->deleteMotor();

        return "Заявка удалена";
    }

    public function actionGetLists() {
        $model = new ApiMotorTransport();

        return $model->getLists();
    }

}