<?php
/**
 * Created by IntelliJ IDEA.
 * User: matjazz
 * Date: 04/01/16
 * Time: 21:34
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

?>

<div class="loginColumns animated fadeInDown">
    <div class="row">

        <div class="col-md-3">


        </div>
        <div class="col-md-6">
            <div class="ibox-content">
                <h2 class="text-center text-info"><b>Admin Panel</b></h2>

                <?php $form = \yii\widgets\ActiveForm::begin(['id' => 'login-form','class' => 'm-t']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                    <br>
                    Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

                <?php \yii\widgets\ActiveForm::end(); ?>
            </div>
        </div>
        <div class="col-md-3">


        </div>
    </div>
    <hr>

</div>
