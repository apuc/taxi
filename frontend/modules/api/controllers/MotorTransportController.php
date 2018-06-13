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

    public function actionIndex() {
//        $user = (\Yii::$app->user->identity) ? \Yii::$app->user->identity->getId() : null;
//        $token = Token::findOne(["user_id" => $user]);
//
//        $model = new ApiMotorTransport();
//
//        return $this->render('index', compact("token", "model"));
        //var_dump($_POST);
        echo '123';
    }


    public function actionAdd(){
        $model = new ApiMotorTransport();

        if (!$model->saveMotor()) {
            return ActiveForm::validate($model);
        }

        return "добавлен пользователь";
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