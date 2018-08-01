<?php

namespace frontend\modules\api\controllers;

use backend\models\User;
use common\helpers\Constants;
use common\models\OptionSettings;
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

class RequestController extends DefaultController
{

    /**
     * экшн с тестовыми данными для проверки работы пост запросов
     * @return string
     */
    public function actionIndex()
    {
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


    public function actionAdd()
    {
        $apiRequest["ApiRequest"] = Yii::$app->request->post();
        $model = new ApiRequest();
        $model->load($apiRequest);
        $model->user_id = $this->user->id;
        $model->dt_add = time();
        if ((int)$model->is_answer === Constants::STATUS_DISABLED) $model->parent_id = null;
        if (!$model->save()) {
            return ActiveForm::validate($model);
        }
        if (isset(Yii::$app->request->post()["settings"])) {
            $model->settings = Yii::$app->request->post()["settings"];
            $this->saveOptionSettings($model);
        }
        $result = $this->getResult("Заявка успешно обработана");
        return $result;
    }

    /**
     * @return array|string
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete()
    {
        $id = Yii::$app->request->post()["id"];
        $model = ApiRequest::findOne($id);
        if (!is_null($model)) {
            $model->delete();
            OptionSettings::findOne(["table_row" => $model->id])->delete();
        }

        return $this->getResult("Заявка удалена");


    }

    public function actionGet()
    {
        $id = Yii::$app->request->post()["id"];
        $model = ApiRequest::findOne($id);

        if (is_null($model)) {

            return $this->getResult("Заявка не найдена", Constants::STATUS_DISABLED);
        }

        $data = [];

        $settings = $this->getOptionSettings($model->tableName(), $model->id);

        foreach ($settings as $item) {
            $data["settings"] = json_decode($item->value);
        }

        $data["model"] = $model->toArray();

        return $data;
    }

    public function actionEdit()
    {
        $id = Yii::$app->request->post()["id"];
        $model = ApiRequest::findOne($id);
        $apiRequest["ApiRequest"] = Yii::$app->request->post();
        $model->load($apiRequest);


        if (is_null($model)) {
            $result = [
                "status" => Constants::STATUS_DISABLED,
                "value" => "Заявка не найдена"
            ];

            return $result;
        }

        if (!$model->update()) {
            return ActiveForm::validate($model);
        }

        if (isset(Yii::$app->request->post()["settings"])) {
            $model->settings = Yii::$app->request->post()["settings"];
            $this->saveOptionSettings($model);
        }

        return $this->getResult("Заявка обновлена");

    }

    public function actionGetLists()
    {
        $modelPost = new ApiRequest();

        $allUsers = isset(Yii::$app->request->post()["all_users"]) ? Yii::$app->request->post()["all_users"] : null;

        $apiRequest["ApiRequest"] = Yii::$app->request->post();
        $modelPost->load($apiRequest);
        $modelPost->validate(); //для установки предела и лимита
        $models = ApiRequest::find();
        if (is_null($allUsers) || $allUsers == Constants::STATUS_DISABLED) {
            $models = $models->where(["user_id" => $this->user->id]);
        } else {
            $models = $models->joinWith("user")->where(["user.status"=>User::STATUS_ACTIVE, "request.status"=>Constants::STATUS_ENABLED]);
        }

        $models = $models->limit($modelPost->limit)->offset($modelPost->offset)->asArray()->all();
        return $models;

    }

    public function actionOption()
    {
        return $this->getOptionSettingsValue("request");
    }
}
