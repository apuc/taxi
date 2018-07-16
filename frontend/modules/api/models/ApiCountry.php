<?php

namespace frontend\modules\api\models;

use common\models\Country;


class ApiCountry extends Country {

    //для пагинации
    public $offset;
    public $limit;
    
    public function rules() {
        $rules = parent::rules();
        $rules[] = [ [ "offset", "limit" ], "integer" ];
        $rules[] = [ [ "offset", "limit" ], "default", "value"=>2];
        return $rules;
    }
}