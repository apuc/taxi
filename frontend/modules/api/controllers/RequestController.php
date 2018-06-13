<?php

namespace frontend\modules\api\controllers;

use common\helpers\Constants;
use common\models\Request;
use common\models\Token;
use frontend\modules\api\models\AddRequest;
use frontend\modules\api\models\DeleteRequest;
use frontend\modules\api\models\EditRequest;
use frontend\modules\api\models\GetLists;
use Yii;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class RequestController extends DefaultController {

	/**
	 * экшн с тестовыми данными для проверки работы пост запросов
	 * @return string
	 */
	public function actionIndex() {
		$user  = ( \Yii::$app->user->identity ) ? \Yii::$app->user->identity->getId() : null;
		$token = Token::findOne( [ "user_id" => $user ] );


		$modelAdd      = new AddRequest();
		$modelDelete   = new DeleteRequest();
		$modelEdit     = new EditRequest();
		$modelGetLists = new GetLists();

		//тестовые данные
		$modelDelete->user_id    = $user;
		$modelDelete->token      = ( $token ) ? $token->token : null;
		$modelDelete->request_id = 1;

		$modelEdit->user_id    = $user;
		$modelEdit->token      = ( $token ) ? $token->token : null;
		$modelEdit->request_id = 2;

		$modelGetLists->token   = ( $token ) ? $token->token : null;
		$modelGetLists->user_id = $user;
//		$modelGetLists->offset = 2;
//		$modelGetLists->limit = 2;

		return $this->render( 'index', compact( "token", "modelAdd", "modelDelete", "modelEdit", "modelGetLists" ) );
	}

	public function actionAdd() {
		$model = new AddRequest();
		$model->load( \Yii::$app->request->post() );

		if ( ! $model->save() ) {
			return ActiveForm::validate( $model );
		}

		$result = [
			"status" => Constants::STATUS_ENABLED,
			"value"  => "Заявка успешно обработана"
		];

		return $result;
	}

	/**
	 * @return array|string
	 * @throws \Exception
	 * @throws \Throwable
	 * @throws \yii\db\StaleObjectException
	 */
	public function actionDelete() {

		$model = new DeleteRequest();
		$model->load( \Yii::$app->request->post() );

		if ( $model->validate() ) {
			$model->deleteRequest();

			$result = [
				"status" => Constants::STATUS_ENABLED,
				"value"  => "Заявка удалена"
			];

			return $result;
		}

		return ActiveForm::validate( $model );

	}

	public function actionEdit() {
		$model = new EditRequest();
		$model->load( \Yii::$app->request->post() );

		if ( $model->validate() ) {
			return $model->getRequest();
		}

		return ActiveForm::validate( $model );
	}

	public function actionGetLists() {
		$model = new GetLists();
		$model->load( \Yii::$app->request->post() );

		if ( $model->validate() ) {
			return $model->getLists();
		}

		return ActiveForm::validate( $model );

	}

}
