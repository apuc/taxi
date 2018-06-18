<?php
/**
 * Created by PhpStorm.
 * User: mecha
 * Date: 15.06.2018
 * Time: 11:30
 */

namespace frontend\modules\api\models;

use common\models\City;

class ApiCity extends City {

    public function rules() {
        $rules = parent::rules();

        return $rules;
    }

}