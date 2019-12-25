<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AuthorRequestsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Запросы автору';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-requests-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Cоздать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'social_instagram',
            'phone',
            'about_me:ntext',
            //'status',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model)
                {
                    $status = [
                            0 => "новый",
                            1 => "подтвердить",
                            3 => "отказать",
                    ];
                    if(empty($role)){
                        return Html::dropDownList('status',$model->status,$status,['data-id' => $model->id]);
                    }
//                    $form = ActiveForm::begin([
//                        'action' => ['index'],
//                        'method' => 'get',
//                    ]);
                    return Html::dropDownList('status',$model->status,$status,['data-id' => $model->id]);
//            ActiveForm::end();


                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
