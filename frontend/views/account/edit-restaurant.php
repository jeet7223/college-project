<?php
$this->title = "Edit Profile | Restaurant";

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
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
                 <?php if(empty($restaurant->restaurant_image)) {?>
                 <img class="profile-thumb" src="<?= \Yii::getAlias('@web/images/user_placeholder.png');?>">
              <?php } else{?>
                 <img class="profile-thumb" src="<?= \Yii::getAlias('@web/uploads/profile_images/'.$restaurant->restaurant_image);?>">
              <?php }?>

                <div class="info-secondary">
                <div class="username"><?= Yii::$app->user->identity->username?> <span class="res-icon"><i class="fa fa-cutlery"></i></span></div> 
                             <div class="registered-date" style="color: #1e1313"><strong><i class="fa fa-calendar"></i> Registered At-:</strong> <span><?= Yii::$app->formatter->asDate(Yii::$app->user->identity->created_at)?></span></div>
              </div>

              </div>

            </div>


        		 <?php $form = ActiveForm::begin(['id' => 'edit-profile-restaurant']); ?>
        		   <div class="row">
                  
                               <div class="col-lg-6">
                        <?= $form->field($model, 'email')->textInput(['autofocus' => true,'disabled' => true]) ?>
                      </div>
                       <div class="col-lg-6">
                        <?= $form->field( $restaurant, 'restaurant_name')->textInput(['autofocus' => true,'disabled' => true]) ?>
                      </div>
                     
                    </div>
                    <div class="row">
                    <div class="col-lg-12">
                        <?= $form->field($restaurant, 'restaurant_description')->textarea(['id'=>'address-input']) ?>
                      </div>
                     
                    </div>
                       
                       <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($restaurant, 'city')->textInput(['autofocus' => true]) ?>
                      </div>
                        <div class="col-lg-6">

                       <?= $form->field($restaurant, 'state')->textInput(['autofocus' => true])  ?>
                             </div>
                    </div>
                        <div class="row">
           
                        <div class="col-lg-12">
                       <?= $form->field($restaurant, 'restaurant_contact_number')->textInput(['autofocus' => true])  ?>
                             </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-12">
                        <?= $form->field($restaurant, 'restaurant_address')->textarea(['id'=>'address-input']) ?>
                      </div>
                     
                    </div>
                <br>
                    <h1>Additional Details</h1>
                <br>
                     <div class="row">
                    <div class="col-lg-12">
                       <?php if(empty($restaurant->restaurant_image)) {?>
                         <?= $form->field($restaurant, 'restaurant_image')->widget(FileInput::classname(), [
                                'options' => ['accept' => 'image/*'],
                                'pluginOptions' => [
                                    'showCaption' => false,
                                    'showCancel'=>false,
                                    'showRemove'=>false,
                                    'showUpload'=>false,
                          
                                    'allowedFileExtensions' => ['jpg','gif','png','jpeg'],
                                
                                     
                                        ],
                            ]); ?>
                       <?php }else{ ?>
                         <?= $form->field($restaurant, 'restaurant_image')->widget(FileInput::classname(), [
                                'options' => ['accept' => 'image/*'],
                                'pluginOptions' => [
                                    'showCaption' => false,
                                    'showCancel'=>false,
                                    'showUpload'=>true,
                                    'showRemove'=>false,
                                    'allowedFileExtensions' => ['jpg','gif','png','jpeg'],
                                    'initialPreview'=> \Yii::getAlias('@web/uploads/profile_images/'.$restaurant->restaurant_image),
                                     'initialPreviewAsData'=>true,
                                        'overwriteInitial'=>true,
                                     
                                        ],
                            ]); ?>

                       <?php }?>
                      </div>
                     
                    </div>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($restaurant,'estimated_delivery_time')->textInput
                        (['placeholder'=>'In Minutes'])?>
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($restaurant, 'restaurant_type')->widget(Select2::classname
                        (), [
                            'data' =>[0=>'Only Veg',1=>'Only Non Veg',2=>'Both Veg and Non Veg'],
                            'theme'=>Select2::THEME_BOOTSTRAP,
                            'size'=>Select2::SIZE_LARGE,
                            'hideSearch'=>true,


                        ]); ?>
                    </div>
                </div>
                <br>
                <span class="service-timing mb-2">Service Timing</span>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($restaurant, 'open_time')->widget(Select2::classname
                        (), [
                            'data' => \common\models\Restaurant::getTimming(),
                            'theme'=>Select2::THEME_BOOTSTRAP,
                            'size'=>Select2::SIZE_LARGE,


                        ]); ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($restaurant, 'close_time')->widget(Select2::classname
                        (), [
                            'data' => \common\models\Restaurant::getTimming(),
                            'theme'=>Select2::THEME_BOOTSTRAP,
                            'size'=>Select2::SIZE_LARGE,


                        ]); ?>
                    </div>
                </div>



                       <br>
                       <br>

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