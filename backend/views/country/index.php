<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Страны';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
		<?= Html::a( 'Добавить страну', [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
    </p>

	<?= GridView::widget( [
		'dataProvider' => $dataProvider,
		'filterModel'  => $searchModel,
		'columns'      => [
			[ 'class' => 'yii\grid\SerialColumn' ],

//            'id',
			'name',

			[
				'class'   => 'yii\grid\ActionColumn',
				'buttons' => [
					'delete' => function ( $url, $model ) {
						return Html::a( '<span class="glyphicon glyphicon-trash"></span>', [
							'delete',
							'id' => $model->id
						], [
							'class' => '',
							'data'  => [
								'confirm' => 'Вы действительно хотите удалить это элемент',
								'method'  => 'post',
							],
						] );
					}
				]

			],
		],
	] ); ?>
</div>
