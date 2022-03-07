<?php
$this->title = "Edit Profile | Customer";

use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="site-content">
<div class="container">
	<div class="row">
		
			
		<?= $this->render('sidebar.php')?>
		<div class="col-lg-9"> 
			<div class="container" id="form-container">
        <div class="heading-title">
        <h1>Edit Profile</h1>
        </div>
        <div class="row">
        	<div class="col-lg-12"> 

               <div class="user-info">
              <div class="content-flex">
                <img class="profile-thumb" src="<?= \Yii::getAlias('@web/images/user_placeholder.png');?>">

                <div class="info-secondary">
                <div class="username"><?= Yii::$app->user->identity->username?> <span class="res-icon"><i class="fa fa-user"></i></span></div> 
                             <div class="registered-date" style="color: #1e1313"><strong><i class="fa fa-calendar"></i> Registered At-:</strong> <span><?= Yii::$app->formatter->asDate(Yii::$app->user->identity->created_at)?></span></div>
              </div>

              </div>

            </div>

        		 <?php $form = ActiveForm::begin(['id' => 'edit-profile-customer']); ?>
        		   <div class="row">

                               <div class="col-lg-12">
                        <?= $form->field($model, 'email')->textInput(['autofocus' => true,'disabled' => true]) ?>
                      </div>
                     
                    </div>
                           <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field( $customer, 'customer_first_name')->textInput(['autofocus' => true]) ?>
                      </div>
                        <div class="col-lg-6">

                        <?= $form->field( $customer, 'customer_last_name')->textInput(['autofocus' => true]) ?>
                             </div>
                    </div>
                      
                        <div class="row">
           
                        <div class="col-lg-6">

                       <?= $form->field($customer, 'customer_contact_number')->textInput(['autofocus' => true])  ?>
                             </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-12">
                        <?= $form->field($customer, 'customer_address')->textarea(['id'=>'address-input']) ?>
                      </div>
                     
                    </div>
                    


                       

                        <div class="form-group">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-common', 'name' =>
                                'signup-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
        	</div>
        </div>
    </div>
		</div>
	</div>
</div>
</div>