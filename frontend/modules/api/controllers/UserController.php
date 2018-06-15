<?php

namespace frontend\modules\api\controllers;

use common\models\LoginForm;
use common\models\Token;
use common\models\User;
use frontend\models\SignupForm;
use frontend\modules\api\models\ApiUser;
use yii\web\Controller;
use yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class UserController extends Controller {

	public $status = 0;
	public $error_msg;
	
	public function beforeAction( $action ) {
		if ( \Yii::$app->request->isPost ) {
				\Yii::$app->response->format = Response::FORMAT_JSON;
				$this->layout                = false;
				return true;
		} else {
			throw  new NotFoundHttpException( 'Страница не найдена', 404 );
		}
	}
	
	
	public function actionIndex() {
		return $this->render( 'index' );
	}

	public function actionAdd() {
		$model = new SignupForm();

		if ( Yii::$app->request->isPost ) {

			$data["SignupForm"] = Yii::$app->request->post();
			$model->load( $data );
			

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
        header('Access-Control-Allow-Origin: *');
        return $this->render( 'index', compact( "model" ) );
	}

	public function actionLogin() {

		$model = new LoginForm();


		if ( Yii::$app->request->isPost ) {
			$data["LoginForm"] = Yii::$app->request->post();
			$model->load( $data );
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
        header('Access-Control-Allow-Origin: *');
        return $this->render( 'login', compact( "model" ) );
	}
	
	public function actionGetUser() {
		$post = Yii::$app->request->post();
		$token = Token::findOne(['token' => $post['token'] ]);
		$user  = User::findOne( $token->user_id );
		if(isset($post['id'])){
			$user = User::findOne(['id' => $post['id']]);
		}
		if($token && $user) {
			$this->status = 1;
		}
		if($this->status == 1) {
			$result = [
				'id' => $user->id,
				'name' => $user->username,
				'date' => $user->created_at,
				'status' => $this->status,
			];
		} else {
			$this->error_msg = 'Пользователь не существует!';
			$result = [ 'status' => $this->status, 'error_msg' => $this->error_msg ];
		}
        header('Access-Control-Allow-Origin: *');
        return $result;
	}
	
	public function actionGetList() {
		$post = Yii::$app->request->post();
		$model = new ApiUser();
		$apiRequest["ApiUser"] = Yii::$app->request->post();
		$token = Token::findOne( [ 'token' => $post['token'] ] );
		if($token) {
			$model->load($apiRequest);
			$users = User::find()->offset($model->offset)->limit($model->limit)->all();
			if($token && $users) {
				$this->status = 1;
			}
		}
		if($this->status == 1) {
			$result = [];
			foreach ( $users as $user ) {
				$result[] = [
					'id'     => $user->id,
					'name'   => $user->username,
					'date' => $user->created_at,
					'status' => $this->status,
				];
			}
		} else {
			$this->error_msg = 'Ошибка токена!';
			$result = [ 'status' => $this->status, 'error_msg' => $this->error_msg ];
		}
        header('Access-Control-Allow-Origin: *');
        return $result;
	}
}