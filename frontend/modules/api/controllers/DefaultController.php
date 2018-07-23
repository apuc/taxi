<?php

namespace frontend\modules\api\controllers;

use common\helpers\Constants;
use common\models\OptionSettings;
use common\models\OptionsSettingsValue;
use common\models\Token;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Default controller for the `api` module
 */
class DefaultController extends Controller
{

    protected $user;

//    public function behaviors()
//    {
//        return array_merge(parent::behaviors(), [

    // For cross-domain AJAX request
    //'corsFilter'  => [
    //    'class' => \yii\filters\Cors::className(),
    //    'cors'  => [
    //        // restrict access to domains:
    //        'Access-Control-Allow-Origin' => '*',
    //        'Access-Control-Request-Method'    => ['POST'],
    //        'Access-Control-Allow-Credentials' => true,
    //        'Access-Control-Max-Age'           => 3600,                 // Cache (seconds)
    //    ],
    //],

//        ]);
//    }

    /**
     * @param \yii\base\Action $action
     *
     * @return bool|string
     * @throws \yii\web\BadRequestHttpException
     * @throws NotFoundHttpException
     */
    public function beforeAction($action)
    {
        if (\Yii::$app->request->isPost) {
            header('Access-Control-Allow-Origin: *');
            if ($action->id == "option-value") {
                \Yii::$app->response->format = Response::FORMAT_JSON;
                $this->layout = false;
                return true;
            }
            $this->user = $this->isToken();
            if ($this->user) {

                \Yii::$app->response->format = Response::FORMAT_JSON;
                $this->layout = false;

                return true;
            } else {
                throw  new NotFoundHttpException('Страница не найдена', 404);
            }


        } else {
            throw  new NotFoundHttpException('Страница не найдена', 404);
        }
    }


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * проверка токена
     * @return bool|null|static
     */
    private function isToken()
    {
        if (isset(Yii::$app->request->post()["token"])) {
            return Token::findOne(["token" => Yii::$app->request->post()["token"]]);
        }

        return false;
    }

    protected function getResult($message, $status = Constants::STATUS_ENABLED)
    {
        $result = [
            "status" => $status,
            "value" => $message
        ];

        return $result;
    }

    protected function getOptionSettingsValue($tableName, $limit = 20, $offset = 0)
    {
        return $settings = OptionsSettingsValue::find()
            ->where(["table_name" => $tableName])
            ->limit($limit)->offset($offset)->asArray()->all();
    }

    protected function getOptionSettings($tableName, $tableRow, $limit = 20, $offset = 0)
    {
        return $settings = OptionSettings::find()
            ->where(["table_name" => $tableName, "table_row" => $tableRow])
            ->limit($limit)->offset($offset)->all();
    }

    protected function addOptionSettings()
    {

    }
}
