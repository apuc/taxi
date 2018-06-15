<?php

namespace frontend\modules\api\models;

use common\models\Country;


class ApiCountry extends Country {

    public function rules() {
        $rules = parent::rules();

        return $rules;
    }
}