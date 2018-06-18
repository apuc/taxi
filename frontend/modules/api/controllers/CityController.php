<?php
/**
 * Created by PhpStorm.
 * User: mecha
 * Date: 15.06.2018
 * Time: 11:32
 */

namespace frontend\modules\api\controllers;

use common\helpers\Constants;
use common\helpers\Folder;
use frontend\modules\api\models\ApiCity;
use Yii;
use yii\widgets\ActiveForm;


class CityController extends DefaultController {

    public function actionAdd() {
        $model = new ApiCity();

        $apiCity["ApiCity"] = Yii::$app->request->post();

        $model->load($apiCity);
        $model->dt_add = time();

        if (!$model->save()) {
            return ActiveForm::validate($model);
        }

        return "Успешно добавлен";
    }

    public function actionDel() {
        $id = Yii::$app->request->post()["id"];
        ApiCity::deleteAll($id);

        return "Заявка удалена";
    }

    public function actionEdit() {
        $id = Yii::$app->request->post()["id"];
        $model = ApiCity::findOne($id);

        $apiCity["ApiCity"] = Yii::$app->request->post();

        $model->load($apiCity);
        $model->dt_add = time();

        if (!$model->save()) {
            return ActiveForm::validate($model);
        }

        return $model->toArray();
    }

    public function actionGetLists() {
        $modelPost = new ApiCity();

        $apiCity["ApiCity"] = Yii::$app->request->post();

        $modelPost->load($apiCity);
        $models = ApiCity::find()->where(['country_id' => $modelPost->country_id])->asArray()->all();

        return $models;
    }
}