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


class CityController extends DefaultController
{

    /**
     * принимает поля name, country_id, slug
     * @return array
     */
    public function actionAdd()
    {
        $model = new ApiCity();

        $apiCity["ApiCity"] = Yii::$app->request->post();

        $model->load($apiCity);
        $model->dt_add = time();

        if (!$model->save()) {
            return ActiveForm::validate($model);
        }

        return $this->getResult("Город успешно добавлен!");
    }

    /**
     * принимает id
     * @return string
     */
    public function actionDelete()
    {
        $id = Yii::$app->request->post()["id"];
        $model = ApiCity::findOne($id);
        if (!is_null($model)) {
            $model->delete();
        }
        return $this->getResult("Город успешно удален!");
    }

    /**
     * принимает поле id
     * @return array
     */
    public function actionGet()
    {
        $id = Yii::$app->request->post()["id"];
        $model = ApiCity::findOne($id);

        if (is_null($model)) {
            return $this->getResult("Город не найден!", Constants::STATUS_DISABLED);
        }

        return $model->toArray();
    }


    /**
     * принимает поле name, country_id, slug
     * @return array
     */
    public function actionEdit()
    {
        $id = Yii::$app->request->post()["id"];
        $model = ApiCity::findOne($id);

        if (is_null($model)) {
            return $this->getResult("Город не найден!", Constants::STATUS_DISABLED);
        }

        $apiCity["ApiCity"] = Yii::$app->request->post();

        $model->load($apiCity);
        $model->dt_add = time();

        if (!$model->save()) {
            return ActiveForm::validate($model);
        }

        return $model->toArray();
    }

    /**
     * принимает поля country_id, limit, offset
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionGetLists()
    {

        $modelPost = new ApiCity();

        $apiCountry["ApiCity"] = Yii::$app->request->post();

        $modelPost->load($apiCountry);

        $modelPost->validate();

        if (is_null($modelPost->country_id)) {
            $models = ApiCity::find()->limit($modelPost->limit)->offset($modelPost->offset)
                ->asArray()->all();
        } else {
//var_dump($modelPost->country_id);die;
            $models = ApiCity::find()->where(['country_id'=> (int)$modelPost->country_id])
                ->limit($modelPost->limit)->offset($modelPost->offset)
                ->asArray()->all();
        }
        
        return $models;
    }
}