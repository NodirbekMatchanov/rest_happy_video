<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel mdm\admin\models\searchs\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('Создать', ['/site/create-guide'], ['class' => 'btn btn-success']) ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'email:email',
            'created_at:date',
//            [
//                'attribute' => 'status',
//                'value' => function ($model) {
//                    return $model->status == 0 ? 'Inactive' : 'Active';
//                },
//                'filter' => [
//                    0 => 'Inactive',
//                    10 => 'Active'
//                ]
//            ],
            [
                'attribute' => 'role',
                'format' => 'raw',
                'value' => function ($model)
                {
                    $role = \backend\components\User::getRole($model->id);
                    if($role == 'admin'){
                        return 'admin';
                        
                    }
                    $status = [];
                    $status = ArrayHelper::map($status, 'name', 'description');
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
           
//            [
//                'attribute' => 'role',
//                'value' => function ($model) {
//                    $assigment =new \mdm\admin\models\Assignment($model->id);
//                    $items = $assigment->getItems();
//                    return implode(',',array_keys($items['assigned']));
//                },
//                'filter' => [
//                    0 => 'Inactive',
//                    10 => 'Active'
//                ]
//            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
                'buttons' => [
                    'activate' => function ($url, $model) {
                        if ($model->status == 10) {
                            return '';
                        }
                        $options = [
                            'title' => Yii::t('rbac-admin', 'Activate'),
                            'aria-label' => Yii::t('rbac-admin', 'Activate'),
                            'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, $options);
                    }
                ]
            ],
        ],
    ]);
    ?>
</div>
