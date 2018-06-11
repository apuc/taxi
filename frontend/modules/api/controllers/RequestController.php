<?php

namespace frontend\modules\api\controllers;

class RequestController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
