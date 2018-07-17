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