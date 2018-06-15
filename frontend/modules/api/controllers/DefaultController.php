<?php

namespace frontend\modules\api\controllers;

use common\models\Token;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Default controller for the `api` module
 */
class DefaultController extends Controller {

    public function behaviors() {
        return array_merge(parent::behaviors(), [

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

        ]);
    }

	/**
	 * @param \yii\base\Action $action
	 *
	 * @return bool|string
	 * @throws \yii\web\BadRequestHttpException
	 * @throws NotFoundHttpException
	 */
	public function beforeAction( $action ) {
		if ( \Yii::$app->request->isPost ) {
			if ( $this->isToken() ) {
                header('Access-Control-Allow-Origin: *');
				\Yii::$app->response->format = Response::FORMAT_JSON;
				$this->layout                = false;

				return true;
			} else {
				throw  new NotFoundHttpException( 'Страница не найдена', 404 );
			}


		} else {
			throw  new NotFoundHttpException( 'Страница не найдена', 404 );
		}
	}


	/**
	 * Renders the index view for the module
	 * @return string
	 */
	public function actionIndex() {
		return $this->render( 'index' );
	}

	/**
	 * проверка токена
	 * @return bool|null|static
	 */
	private function isToken() {
		if (isset(Yii::$app->request->post()["token"])){
			return Token::findOne( [ "token" => Yii::$app->request->post()["token"] ] );
		}

		return false;

	}
}
