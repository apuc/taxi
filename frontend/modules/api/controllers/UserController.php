<?php

namespace frontend\modules\api\controllers;

use common\helpers\Folder;
use common\models\LoginForm;
use common\models\Profile;
use common\models\Token;
use common\models\User;
use frontend\models\SignupForm;
use frontend\modules\api\models\ApiProfile;
use frontend\modules\api\models\ApiUser;
use yii\web\Controller;
use yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class UserController extends Controller {

	public $status = 0;
	public $error_msg;
	public $user;
	private $token;
	public $post;
	public $profile;
	
	public function beforeAction( $action ) {
		if ( \Yii::$app->request->isPost ) {
			$this->post = Yii::$app->request->post();
			\Yii::$app->response->format = Response::FORMAT_JSON;
			$this->layout                = false;
			header('Access-Control-Allow-Origin: *');
			if( $action->id != 'login' && $action->id != 'add' ){
				if ( $this->isToken() ) {
					$this->token = $this->isToken();
					$this->user = User::findOne( $this->token->user_id );
					$this->profile = Profile::findOne(['user_id' => $this->token->user_id]);
					return true;
				} else {
					throw  new NotFoundHttpException( 'Страница не найдена', 404 );
				}
			}
			return true;
		} else {
			throw  new NotFoundHttpException( 'Страница не найдена', 404 );
		}
	}
	
	public function actionIndex() {
		return $this->render( 'index' );
	}
	
	private function isToken() {
		if (isset(Yii::$app->request->post()["token"])){
			return Token::findOne( [ "token" => Yii::$app->request->post()["token"] ] );
		}
		return false;
	}

	public function actionAdd() {
		$model = new SignupForm();

		if ( Yii::$app->request->isPost ) {

			$data["SignupForm"] = Yii::$app->request->post();
			$model->load( $data );
			
			$user = $model->signup();
            header('Access-Control-Allow-Origin: *');
			//вывод ошибок из модели юзера
			if ( is_array( $user ) ) {
				return $user;
			}
			$this->status = 1;
			return [
				"status"   => $this->status,
				"id"       => $user->id,
				"username" => $user->username,
				"email"    => $user->email
			];

		}
        return $this->render( 'index', compact( "model" ) );
	}

	public function actionLogin() {
		$model = new LoginForm();

		if ( Yii::$app->request->isPost ) {
            header('Access-Control-Allow-Origin: *');
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
		$user = $this->user;
		if(isset($this->post['id'])){
			$user = User::findOne(['id' => $this->post['id']]);
		}
		if($this->token && $user) {
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
		$model = new ApiUser();
		$apiRequest["ApiUser"] = Yii::$app->request->post();
		$model->load($apiRequest);
		$users = User::find()->offset($model->offset)->limit($model->limit)->all();
		if($this->token && $users) {
			$this->status = 1;
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
        return $result;
	}
	
	public function actionEdit() {
		if($this->post['email']) {
			if(User::find()->where(['like', 'email', $this->post['email']])->one()) {
				$this->error_msg = 'Почта уже успользуется!';
				$result = [ 'status' => $this->status, 'error_msg' => $this->error_msg ];
				return $result;
			}
			$this->user->email = $this->post['email'];
			if(!$this->user->save()) {
				$this->error_msg = 'Ошибка!';
				$result = [ 'status' => $this->status, 'error_msg' => $this->error_msg ];
			} else {
				$this->status = 1;
				$result = ['email' => $this->post['email'], 'message' => 'Почта изменена!', 'status' => $this->status,];
			}
			return $result;
		}
		if($this->post['password']) {
			if(!$this->user->validatePassword($this->post['password'])){
				$this->error_msg = 'Введите старый пароль!';
				return $result = [ 'status' => $this->status, 'error_msg' => $this->error_msg ];
			} else {
				if(!$this->post['new_password']){
					$this->error_msg = 'Введите новый пароль!';
					return $result = [ 'status' => $this->status, 'error_msg' => $this->error_msg ];
				}
			}
			$this->user->setPassword($this->post['new_password']);
			$this->user->generateAuthKey();
			if(!$this->user->save()) {
				$this->error_msg = 'Ошибка!';
				$result = [ 'status' => $this->status, 'error_msg' => $this->error_msg ];
			} else {
				$this->status = 1;
				$result = ['password' => $this->post['new_password'], 'message' => 'Пароль изменен!', 'status' => $this->status,];
			}
			return $result;
		}
		return false;
	}
	
	private function SaveImg($img) {
		$dir = '/media/upload/' . Yii::$app->request->post()["user_id"] . '/' . date('Y-m-d') . '/';
		$path = Yii::getAlias('@frontend/web' . $dir);
		$folderCreate = new Folder($path, 0775);
		$folderCreate->create();
		
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$name = uniqid() . '.png';
		$file = $path . $name;
		file_put_contents($file, $data);
		
		return $file;
	}
	
	public function actionAvatar() {
		if($this->profile) {
			unlink($this->profile->avatar);
			$this->profile->avatar = $this->SaveImg($this->post['avatar']);
			$this->profile->updated_at = time();
			if(!$this->profile->save()) {
				$this->error_msg = 'Ошибка загрузки файла!';
				$result       = [ 'id' => $this->profile->user_id,'message' => $this->error_msg,'status' => $this->status, ];
			} else {
				$this->status = 1;
				$result       = [ 'id' => $this->profile->user_id,'message' => 'Аватар изменен!','status' => $this->status, ];
			}
			return $result;
		}
		$model = new ApiProfile();
		$apiProfile["ApiProfile"] = Yii::$app->request->post();
		
		$model->load( $apiProfile );
		$model->user_id = $this->token->user_id;
		$model->avatar     = $this->SaveImg( $model->avatar );
		$model->created_at = time();
		$model->updated_at = time();
		if ( ! $model->save() ) {
			return ActiveForm::validate( $model );
		}
		$this->status = 1;
		$result       = [ 'id' => $model->user_id,'message' => 'Аватар добавлен!','status' => $this->status, ];
		
		return $result;
	}
	
	public function actionProfile() {
		$model = new ApiProfile();
		$apiRequest["ApiProfile"] = Yii::$app->request->post();
		$model->load($apiRequest);
		if(isset($model->sex)) {
			if($model->sex != 1 && $model->sex != 2) {
				$this->error_msg = 'Введите 1 или 2 где 1 - мужской, 2 - женский!';
				return 	$result = [
					"status" => $this->status,
					"message" => $this->error_msg,
				];
			}
		}
		if(!$this->profile) {
			$model->user_id = $this->user->id;
			$model->created_at = time();
			$model->updated_at = time();
			$model->save();
			$this->status = 1;
			$this->error_msg = 'Данные профиля добавлены!';
			return $result = [
				"status" => $this->status,
				"message" => $this->error_msg,
			];
		} else {
			$this->profile->updated_at = time();
			$this->profile->name = $model->name ?? $this->profile->name ;
			$this->profile->sex = $model->sex ?? $this->profile->sex;
			$this->profile->age = $model->age ?? $this->profile->age;
			$this->profile->phone = $model->phone ?? $this->profile->phone;
		}
		if (!$this->profile->save()) {
			return ActiveForm::validate($model);
		}
		$this->status = 1;
		$this->error_msg = 'Данные профиля сохранены!';
		$result = [
			"status" => $this->status,
			"message" => $this->error_msg,
		];
		return $result;
	}
}