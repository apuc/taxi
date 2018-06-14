<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\City */

$this->title                   = "Просмотр";
$this->params['breadcrumbs'][] = [ 'label' => 'Город', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-view">

    <p>
		<?= Html::a( 'Обновить', [ 'update', 'id' => $model->id ], [ 'class' => 'btn btn-primary' ] ) ?>
		<?= Html::a( 'Удалить', [ 'delete', 'id' => $model->id ], [
			'class' => 'btn btn-danger',
			'data'  => [
				'confirm' => 'Вы действительно хотите удалить город?',
				'method'  => 'post',
			],
		] ) ?>
    </p>

	<?= DetailView::widget( [
		'model'      => $model,
		'attributes' => [
//            'id',
			'name',
			'slug',
//            'dt_add',
			[
				"attribute" => 'dt_add',
				"value"     => function ( $model ) {
					/**
					 * @var backend\models\City $model
					 */
					return \common\helpers\FormatedDate::asDate($model->dt_add);
				}
			],
			[
				"attribute" => "country_id",
				"filter"    => \yii\helpers\ArrayHelper::map( \common\models\Country::find()->all(), "id", "name" ),
				"value"     => function ( $model ) {
					/**
					 * @var backend\models\City $model
					 */
					return $model->country->name;
				}
			],
		],
	] ) ?>

</div>
