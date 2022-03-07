<?php
$this->title = "Restaurants | Online Food Delivery";
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
