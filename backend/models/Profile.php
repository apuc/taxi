<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27.07.18
 * Time: 16:08
 */

namespace backend\models;


class Profile extends \common\models\Profile
{
    public $file;

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [["file"], "file"];
        return $rules;
    }
    
    
}