<?php

namespace frontend\modules\api\controllers;

use common\models\LoginForm;
use common\models\Token;
use common\models\User;
use frontend\models\SignupForm;
use yii\web\Controller;
use yii;

class UserController extends Controller {

	public $status = 0;
	public $error_msg;

	public function actionIndex() {
		return $this->render( 'index' );
	}

	public function actionAdd() {
		$model = new SignupForm();

		if ( Yii::$app->request->isPost ) {
			$model->load( Yii::$app->request->post() );
			\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

			$user = $model->signup();

			//вывод ошибок из модели юзера
			if ( is_array( $user ) ) {
				return $user;
			}

			return [
				"status"   => $user->status,
				"id"       => $user->id,
				"username" => $user->username,
				"email"    => $user->email
			];

		}

		return $this->render( 'index', compact( "model" ) );
	}

	public function actionLogin() {
		if ( ! Yii::$app->user->isGuest ) {
			return $this->goHome();
		}
		$model = new LoginForm();


		if ( Yii::$app->request->isPost ) {
			$model->load( Yii::$app->request->post() );
			\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

			if ( $model->login() ) {
				$user            = User::getUser( $model->username );
				$token           = new Token();
				$token->user_id  = $user->id;
				$token->token    = bin2hex( openssl_random_pseudo_bytes( 64 ) );
				$token->date_add = time();
				$token->save();
				$this->status = 1;

				return [ 'status' => $this->status, 'token' => $token->token ];
			} else {
				$this->error_msg = 'Неверно введены данные!';

				return [ 'status' => $this->status, 'error_msg' => $this->error_msg ];
			}
		}

		return $this->render( 'login', compact( "model" ) );
	}
}
