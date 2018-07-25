<?php
/**
 * Created by PhpStorm.
 * User: mecha
 * Date: 13.06.2018
 * Time: 11:00
 */

namespace frontend\modules\api\models;

use common\models\MotorTransport;


class ApiMotorTransport extends MotorTransport {

    public $offset;
    public $limit;
    public $settings;
    public function rules() {
        $rules = parent::rules();
        $rules[] = [ [ "offset", "limit" ], "integer" ];
        $rules[] = [ [ "offset", "limit" ], "default", "value"=>2];
        return $rules;
    }
}