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


class ApiMotorTransport extends MotorTransport {


    public function rules() {
        $rules = parent::rules();

        return $rules;
    }

    public function deleteMotor() {
        MotorTransport::deleteAll($this->user_id);
    }

    public function getMotor() {
        return MotorTransport::findOne($this->user_id)->toArray();
    }

    public function getLists() {
        return MotorTransport::find()->where(['user_id'=>$this->user_id])->asArray()->one();
    }
}