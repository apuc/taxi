<?php
/**
 * Created by PhpStorm.
 * User: mecha
 * Date: 13.06.2018
 * Time: 11:00
 */

namespace frontend\modules\api\models;


use common\helpers\Constants;
use common\models\MotorTransport;
use yii\base\Model;


class ApiMotorTransport extends Model {

    public $user_id;
    public $brand;
    public $model;
    public $year;
    public $photo;
    public $status;
    public $dt_add;

    public function rules() {
        $rules = parent::rules();

        $rules[] = [['user_id', 'year', 'status', 'dt_add'], 'integer'];
        $rules[] = [['brand', 'model', 'photo'], 'string'];
        $rules[] = [['type'], 'string', 'max' => 255];

        return $rules;
    }

    public function saveMotor() {
        $model = new MotorTransport();

        $model->user_id = \Yii::$app->user->getId();
        $model->status = Constants::STATUS_ENABLED;
        $model->brand = $this->brand;
        $model->model = $this->model;
        $model->year = $this->year;
        $model->photo = $this->photo;
        $model->dt_add = time();

        //на время создания запросов валидация игнорируется
        return $model->save(false);
    }

    public function deleteMotor() {
        MotorTransport::deleteAll($this->user_id);
    }

    public function getMotor() {
        return MotorTransport::findOne($this->user_id)->toArray();
    }

    public function getLists() {
        return MotorTransport::find()->where(['user_id'=>1])->asArray()->one();
    }
}