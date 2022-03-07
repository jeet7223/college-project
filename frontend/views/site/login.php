<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login | Food Delivery Service';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-content">
<div class="site-login">
    <div class="container" id="form-container">
        <div class="heading-title text-center">
        <h1>Login</h1>

        <p>Please fill out the following fields to login:</p>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                 <div class="forgot-password mb-3">
                <?= Html::a('Forgot Password?', ['site/request-password-reset']) ?>
                 </div>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-common', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
</div>