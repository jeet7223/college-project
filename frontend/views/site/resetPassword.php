<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
>
<div class="site-content">
    <div class="site-login">
        <div class="container" id="form-container">
            <div class="heading-title text-center">
                <h1><?= Html::encode($this->title) ?></h1>

                <p>Please choose your new password:</p>
            </div>

            <div class="row">
                <div class="col-lg-12">

                    <?php $form = ActiveForm::begin(['id' => 'reset-password-form','options'=>['class'=>'form-center']]); ?>

                    <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Save', ['class' => 'btn btn-common']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

    </div>
</div>