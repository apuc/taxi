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

	/**
	 * @param \yii\base\Action $action
	 *
	 * @return bool|string
	 * @throws \yii\web\BadRequestHttpException
	 * @throws NotFoundHttpException
	 */
	public function beforeAction( $action ) {

		if ( $action->id == "index" ) {
			return parent::beforeAction( $action );
		}

		if ( \Yii::$app->user->isGuest ) {
			$this->redirect( Yii::$app->getHomeUrl() );

			return false;
		}


		if ( \Yii::$app->request->isPost === parent::beforeAction( $action ) ) {

			if ($this->isToken()) {
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

	private function isToken() {
		return Token::findOne( [ "user_id" => Yii::$app->user->getId() ] )->token == Yii::$app->request->post()["token"];
	}
}
