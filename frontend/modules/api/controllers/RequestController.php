<?php

namespace frontend\modules\api\controllers;

use common\helpers\Constants;
use common\models\Request;
use common\models\Token;
use frontend\modules\api\models\AddRequest;
use frontend\modules\api\models\ApiRequest;
use frontend\modules\api\models\DeleteRequest;
use frontend\modules\api\models\EditRequest;
use frontend\modules\api\models\GetLists;
use Yii;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class RequestController extends DefaultController {

    /**
     * экшн с тестовыми данными для проверки работы пост запросов
     * @return string
     */
    public function actionIndex() {
        $user = (\Yii::$app->user->identity) ? \Yii::$app->user->identity->getId() : null;
        $token = Token::findOne(["user_id" => $user]);


        $modelAdd = new ApiRequest();
        $modelDelete = new ApiRequest();
        $modelEdit = new ApiRequest();
        $modelGetLists = new ApiRequest();

        //тестовые данные
        $modelAdd->user_id = Yii::$app->user->getId();
        $modelAdd->car_id = 1;
//		$modelAdd->dt_add  = time();


        $modelDelete->id = 4;

        $modelEdit->id = 8;
//
//		$modelGetLists->token   = ( $token ) ? $token->token : null;
        $modelGetLists->user_id = $user;
        $modelGetLists->limit = 3;
        $modelGetLists->offset = 1;

        return $this->render('index', compact("token", "modelAdd", "modelDelete", "modelEdit", "modelGetLists"));
    }


    public function actionAdd() {
        $apiRequest["ApiRequest"] = Yii::$app->request->post();

        $model = new ApiRequest();

        $model->load($apiRequest);
        $model->dt_add = time();

        if (!$model->save()) {
            return ActiveForm::validate($model);
        }

        $result = [
            "status" => Constants::STATUS_ENABLED,
            "value" => "Заявка успешно обработана"
        ];

        return $result;
    }

    /**
     * @return array|string
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete() {
        $id = Yii::$app->request->post()["id"];
        $model = ApiRequest::findOne($id);
        if (!is_null($model)) {
            $model->delete();
        }

        $result = [
            "status" => Constants::STATUS_ENABLED,
            "value" => "Заявка удалена"
        ];

        return $result;


    }

    public function actionEdit() {
        $id = Yii::$app->request->post()["id"];
        $model = ApiRequest::findOne($id);

        if (is_null($model)) {
            $result = [
                "status" => Constants::STATUS_DISABLED,
                "value" => "Заявка не найдена"
            ];

            return $result;
        }

        return $model->toArray();
    }

    public function actionGetLists() {
        $modelPost = new ApiRequest();

        $apiRequest["ApiRequest"] = Yii::$app->request->post();


        $modelPost->load($apiRequest);
        $models = ApiRequest::find()->where(["user_id" => $modelPost->user_id])->limit($modelPost->limit)->offset($modelPost->offset)->asArray()->all();

        return $models;

    }

}
