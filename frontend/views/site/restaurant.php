<?php
$this->title = "Restaurants | Online Food Delivery";

use kartik\select2\Select2;
use kartik\typeahead\Typeahead;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
use yii\widgets\ListView;
?>
<div class="restaurant-view">
    <div class="container">
        <div class="row">



            <div class="col-lg-12">
                <div class="container mt-3" id="form-container">
                    <div class="heading-title">
                        <h2 style="color: #d65106;"><i class="fa fa-filter"></i> Filter</h2>
                    </div>
                    <div class="search-form">
                        <?php $form =  \yii\bootstrap\ActiveForm::begin
                        (['action'=>\yii\helpers\Url::to
                        (['site/search'])
                        ]);
                        $model = new \common\models\Restaurant();
                        $model->scenario = \common\models\Restaurant::SCENARIO_SEARCH;
                        ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <?=
                                $form->field($model, 'search_param_1')->widget(Typeahead::classname(), [
                                    'options' => ['placeholder' => 'Search For Restaurant and Dishes'],
                                    'pluginOptions' => ['highlight'=>true],
                                    'dataset' => [
                                        [
                                            'local' => \common\models\Restaurant::getBannerData(),
                                            'limit' => 10
                                        ]
                                    ]
                                ])
                                ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model,'location')->textInput
                                (['placeholder'=>'Location','id'=>'location_input'])?>
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
                                <?= $form->field($model, 'sub_category')->widget
                                (Select2::classname(), [
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
                                <?= $form->field($model, 'restaurant_type')->widget(Select2::classname
                                (), [
                                    'options'=>['placeholder'=>'Select Restaurant Type'],
                                    'data' =>[0=>'Only Veg',1=>'Only Non Veg',2=>'Both Veg and Non Veg'],
                                    'theme'=>Select2::THEME_BOOTSTRAP,
                                    'size'=>Select2::SIZE_LARGE,
                                    'hideSearch'=>true,


                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <?= \yii\helpers\Html::submitButton('Search',
                                    ['class'=>'btn 
                        btn-common',
                                        'style'=>'height:70px;','id'=>'search-item-button'
                                    ])?>
                            </div>
                        </div>
                        <?php \yii\bootstrap\ActiveForm::end()?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">



            <div class="col-lg-12">

                    <div class="restaurants-card mt-3">
                        <?=

                        ListView::widget([
                            'dataProvider' => $dataProvider,
                            'itemView' => '_restaurant',
                            'summary'=>false,
                            'itemOptions' => ['class' => 'col-lg-6'],
                            'options' => [

                                'class' => 'row',
                                'id'=>false

                            ]
                        ]);
                        ?>
                    </div>

                </div>
        </div>
    </div>
</div>
