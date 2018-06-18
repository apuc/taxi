<?php
/**
 * Created by PhpStorm.
 * User: mecha
 * Date: 15.06.2018
 * Time: 11:42
 */

namespace frontend\modules\api\controllers;


use common\models\Country;
use frontend\modules\api\models\ApiCountry;
use Yii;
use yii\widgets\ActiveForm;

class CountryController extends DefaultController {

    public function actionAdd() {
        $model = new ApiCountry();

        $apiCountry["ApiCountry"] = Yii::$app->request->post();

        $model->load($apiCountry);

        if(Country::find()->where(['name'=>$model->name]))
            return 'Такой город уже существует';

        if (!$model->save()) {
            return ActiveForm::validate($model);
        }

        return "Успешно добавлен";
    }

    public function actionDel() {
        $id = Yii::$app->request->post()["id"];
        ApiCountry::deleteAll($id);

        return "Заявка удалена";
    }

    public function actionEdit() {
        $id = Yii::$app->request->post()["id"];
        $model = ApiCountry::findOne($id);
        $apiCountry["ApiCountry"] = Yii::$app->request->post();

        $model->load($apiCountry);
        if(Country::find()->where(['name'=>$model->name])->one())
            return 'Такая страна уже существует';

        if (!$model->save()) {
            return 'Ошибка редактирования';
        }

        return $model->toArray();
    }

    public function actionGetLists() {
        $modelPost = new ApiCountry();

        $apiCountry["ApiCountry"] = Yii::$app->request->post();

        $modelPost->load($apiCountry);
        $models = ApiCountry::find()->where(['name' => $modelPost->name])->asArray()->one();

        return $models;
    }
}