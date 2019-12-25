<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AuthorRequests */

$this->title = 'Create Author Requests';
$this->params['breadcrumbs'][] = ['label' => 'Author Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-requests-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
