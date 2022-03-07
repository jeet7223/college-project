<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;


/* @var $this yii\web\View */
/* @var $model common\models\FoodItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="food-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-12">
    <?= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>
        </div>
         
     </div>
    <div class="row">
        <div class="col-lg-12">
    <?= $form->field($model, 'item_description')->textarea(['rows' => 6]) ?>
     </div>
     </div>
      <div class="row">
    <div class="col-lg-12">
       <?php if(empty($model->item_image)) {?>
         <?= $form->field($model, 'item_image')->widget(FileInput::classname(), [
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
         <?= $form->field($model, 'item_image')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'showCaption' => false,
                    'showCancel'=>false,
                    'showUpload'=>true,
                    'showRemove'=>false,
                    'showUpload'=>false,
          
                    'allowedFileExtensions' => ['jpg','gif','png','jpeg'],
                    'initialPreview'=> \Yii::getAlias('@web/uploads/item_images/'.$model->item_image),
                     'initialPreviewAsData'=>true,
                        'overwriteInitial'=>true,
                     
                        ],
            ]); ?>

       <?php }?>
      </div>
     
    </div>
     <div class="row">
         
          <div class="col-lg-6">
            <?= $form->field($model, 'item_price')->textInput(['maxlength' => true,'placeholder'=>'₹']) ?>
          </div>
           <div class="col-lg-6">
            <?= $form->field($model, 'status')->widget(Select2::classname(), [
                'theme'=>Select2::THEME_BOOTSTRAP,
                'size'=>Select2::SIZE_LARGE,
                'hideSearch'=>true,
                'data' => [1=>'Active',0=>'Inactive'],
              
            ]); ?>
          </div>
     </div>

   
    

     <div class="row">
         
          <div class="col-lg-6">
            <?= $form->field($model, 'category')->widget(Select2::classname(), [
                 'options'=>['placeholder'=>'Select Category'],
                 'data' => \yii\helpers\ArrayHelper::map(\common\models\Category::find()->where(['status'=>1])->all(),'id','category_name'),
                'theme'=>Select2::THEME_BOOTSTRAP,
                'size'=>Select2::SIZE_LARGE,
                'hideSearch'=>true,
               
              
            ]); ?>
          </div>
           <div class="col-lg-6">
            <?= $form->field($model, 'subcategory')->widget(Select2::classname(), [
                'options'=>['placeholder'=>'Select Sub Category'],
                 'data' => \yii\helpers\ArrayHelper::map(\common\models\SubCategory::find()->where(['status'=>1])->all(),'id','sub_category_name'),
                'theme'=>Select2::THEME_BOOTSTRAP,
                'size'=>Select2::SIZE_LARGE,
                'hideSearch'=>true,
               
              
            ]); ?>
          </div>
     </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'type')->widget(Select2::classname
            (), [
                'data' =>[0=>'Veg',1=>'Non Veg'],
                'theme'=>Select2::THEME_BOOTSTRAP,
                'size'=>Select2::SIZE_LARGE,
                'hideSearch'=>true,


            ]); ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-common']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
