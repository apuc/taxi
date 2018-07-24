<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Города';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-index">
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
		<?= Html::a( 'Добавить город', [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
    </p>

	<?= GridView::widget( [
		'dataProvider' => $dataProvider,
		'filterModel'  => $searchModel,
		'columns'      => [
			[ 'class' => 'yii\grid\SerialColumn' ],

//            'id',
			'name',
			'slug',
//			'dt_add',
			[
				"attribute" => 'dt_add',
				"value"     => function ( $model ) {
					/**
					 * @var backend\models\City $model
					 */
					return \common\helpers\FormatedDate::asDate($model->dt_add);
				}
			],
//            'country_id',
			[
				"attribute" => "country_id",
				"filter"=>\yii\helpers\ArrayHelper::map(\common\models\Country::find()->all(), "id", "name"),
				"value"     => function ( $model ) {
					/**
					 * @var backend\models\City $model
					 */
					return ($model->country) ? $model->country->name : "Страна не указана";
				}
			],

			[ 'class' => 'yii\grid\ActionColumn' ],
		],
	] ); ?>
</div>
