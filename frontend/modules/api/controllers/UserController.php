<?php

namespace frontend\modules\api\controllers;

use common\models\LoginForm;
use common\models\Token;
use common\models\User;
use frontend\models\SignupForm;
use yii\web\Controller;
use yii;

class UserController extends Controller
{
 
	public $status = 0;
	public $error_msg;
	
	public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionAdd() {
		    $model = new SignupForm();
		    if(Yii::$app->request->post()) {
		    	$post = Yii::$app->request->post();
		    	$model->username = $post['login'];
		    	$model->email = $post['email'];
		    	$model->password = $post['pass'];
			    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			    if(!$model->username) {
				    $this->error_msg = 'Не заполнен логин';
				    return ['status' => $this->status , 'error_msg' => $this->error_msg];
			    }
			    if(!$model->email) {
				    $this->error_msg = 'Не заполнен email';
				    return ['status' => $this->status, 'error_msg' => $this->error_msg];
			    }
			    if(!$model->password) {
				    $this->error_msg = 'Не заполнен password';
				    return ['status' => $this->status, 'error_msg' => $this->error_msg];
			    }
		    	if($model->signup()) {
				    $user = User::getUser($model->username);
				    $this->status = 1;
				    return ['status' => $this->status, 'id' => $user->id, 'login' => $user->username, 'email' => $user->email];
			    } else {
				    $this->error_msg = 'Логин или почта уже используется!';
				    return ['status' => $this->status, 'error_msg' => $this->error_msg];
			    }
		    }
	    return $this->render('index');
    }
	
    public function actionLogin() {
	    if (!Yii::$app->user->isGuest) {
		    return $this->goHome();
	    }
	    $model = new LoginForm();
	    if(Yii::$app->request->post()) {
		    $post = Yii::$app->request->post();
		    $model->username = $post['login'];
		    $model->password = $post['pass'];
		    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		    if(!$model->username) {
			    $this->error_msg = 'Не введен логин';
			    return ['status' => $this->status , 'error_msg' => $this->error_msg];
		    }
		    if(!$model->password) {
			    $this->error_msg = 'Не введен пароль';
			    return ['status' => $this->status , 'error_msg' => $this->error_msg];
		    }
		    if($model->login()){
			    $user = User::getUser($model->username);
			    $token = new Token();
			    $token->user_id = $user->id;
			    $token->token = bin2hex(openssl_random_pseudo_bytes(64));
			    $token->date_add = time();
			    $token->save();
			    $this->status = 1;
		    	return ['status' => $this->status, 'token' => $token->token];
		    } else  {
		    	$this->error_msg = 'Неверно введены данные!';
		    	return ['status' => $this->status, 'error_msg' => $this->error_msg];
		    }
	    }
	    return $this->render('login');
    }
}
