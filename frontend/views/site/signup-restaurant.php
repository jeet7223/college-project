<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Register - Restaurant | Food Delivery Service';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-content">
    <div class="site-contact">
        <div class="container" id="form-container">
            <div class="heading-title text-center">
                <strong><span style="color: #d65106">Register</span> Restaurant</strong>

                <p>Please fill out the following fields to register:</p>
            </div>

            <div class="row">
                    <div class="col-lg-12">

                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                           <div class="row">
                    <div class="col-lg-12">
                        <?= $form->field($model, 'restaurant_name')->textInput(['autofocus' => true]) ?>
                      </div>
                       
                    </div>
                     <div class="row">
                    <div class="col-lg-12">
                        <?= $form->field($model, 'restaurant_description')->textarea() ?>
                      </div>
                     
                    </div>
                        <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                      </div>
                        <div class="col-lg-6">

                       <?= $form->field($model, 'password')->passwordInput() ?>
                             </div>
                    </div>
                        <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
                      </div>
                        <div class="col-lg-6">

                       <?= $form->field($model, 'restaurant_contact_number')->textInput(['autofocus' => true])  ?>
                             </div>
                    </div>
                     <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($model, 'city')->textInput(['autofocus' => true]) ?>
                      </div>
                        <div class="col-lg-6">

                       <?= $form->field($model, 'state')->textInput(['autofocus' => true])  ?>
                             </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-12">
                        <?= $form->field($model, 'restaurant_address')->textarea(['id'=>'address-input']) ?>
                      </div>
                     
                    </div>




                       

                        <div class="form-group">
                            <?= Html::submitButton('Register!', ['class' => 'btn btn-common', 'name' =>
                                'signup-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
        </div>
    </div>
</div>
