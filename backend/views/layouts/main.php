<?php
/**
 * Created by IntelliJ IDEA.
 * User: matjazz
 * Date: 06/01/16
 * Time: 07:52
 */

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

\backend\assets\AppAsset::register($this);
\backend\assets\InspiniaAsset::register($this);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/smartysoft/yii2-smartysoft-inspinia/assets');

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="<?= (Yii::$app->controller->action->id==='login') ? 'gray-bg':'' ?>">

<?php $this->beginBody() ?>

<div id="wrapper">


    <?php if (!Yii::$app->user->isGuest) : ?>
        <?= $this->render('sidebar.php', ['directoryAsset' => $directoryAsset]) ?>
    <?php endif; ?>


    <?php if (!Yii::$app->user->isGuest) : ?>
    <div id="page-wrapper" class="gray-bg dashbard-1" style="min-height: 576px;">
        <?= $this->render('header.php', ['directoryAsset' => $directoryAsset]) ?>

        <div class="row white-bg">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                    <div class="row col-lg-12">
                        <?= $this->render('content.php', ['directoryAsset' => $directoryAsset, 'content'=>$content]) ?>
                    </div>
                </div>
            </div>
        </div>

        <!--
        <?= $this->render('footer.php', ['directoryAsset' => $directoryAsset]) ?>
        -->

    </div>
    <?php else : ?>

        <?= $this->render('content.php', ['directoryAsset' => $directoryAsset, 'content'=>$content]) ?>

    <?php endif; ?>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
