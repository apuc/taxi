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

    /**
     * принимает поле name
     * @return array
     */
    public function actionAdd() {
        $model = new ApiCountry();

        $apiCountry["ApiCountry"] = Yii::$app->request->post();

        $model->load($apiCountry);

        if (!$model->save()) {
            return ActiveForm::validate($model);
        }
        return $this->getResult("Страна успешно добавлена!");
    }

    /**
     * принимает поле id
     * @return array
     */
    public function actionDelete() {
        $id = Yii::$app->request->post()["id"];
        $model = ApiCountry::findOne($id);
        if (!is_null($model)){
            $model->delete();
        }
        return $this->getResult("Страна успешно удалена!");
    }

    /**
     * принимает поле id
     * @return array
     */
    public function actionGet(){
        $id = Yii::$app->request->post()["id"];
        $model = ApiCountry::findOne($id);

        if (is_null($model)) {
            return $this->getResult("Страна не найдена!");
        }

        return $model->toArray();
    }

    /**
     * принимает поле id, name
     * @return array
     */
    public function actionEdit() {
        $id = Yii::$app->request->post()["id"];
        $model = ApiCountry::findOne($id);
        $apiCountry["ApiCountry"] = Yii::$app->request->post();

        $model->load($apiCountry);

        if (!$model->save()) {
            return ActiveForm::validate($model);
        }

        return $model->toArray();
    }

    /**
     *
     * @return array|null|\yii\db\ActiveRecord
     */
    public function actionGetLists() {
        $modelPost = new ApiCountry();

        $apiCountry["ApiCountry"] = Yii::$app->request->post();

        $modelPost->load($apiCountry);

        $modelPost->validate();

        $models = ApiCountry::find()->limit($modelPost->limit)->offset($modelPost->offset)->asArray()->all();

        return $models;
    }
}