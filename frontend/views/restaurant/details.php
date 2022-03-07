<?php
/* @var $restaurant \common\models\Restaurant */
/* @var $dataProvider \common\models\Restaurant */
$this->title = $restaurant->restaurant_name." | Items";
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
use yii\widgets\ListView;
use yii\widgets\Pjax;

?>
<style>
    #restaurant-details{
        background: url('<?=Yii::getAlias('@web/images/all-bg.jpg')?>') no-repeat;
    }
</style>
<div class="all-page-title page-breadcrumb" id="restaurant-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                    <div class="d-lg-flex">
                        <img class="restaurant-image" src="<?= Yii::getAlias('@web/uploads/profile_images/'
                            .$restaurant->restaurant_image)?>">
                       <div class="restaurant-details">
                           <div class="row">
                               <div class="col-lg-12">
                                   <div class="item-name">
                                       <?= $restaurant->restaurant_name?>
                                   </div>
                                   <div class="restaurant-type"><?=
                                       $restaurant->getRestaurantType($restaurant->restaurant_type)?> </div>
                                   <div class="restaurant-address"><i class="fa fa-map-marker"> </i> <span><?=
                                           $restaurant->restaurant_address?>, <?= $restaurant->city?>, <?=
                                           $restaurant->state?></span></div>
                                   <div class="list-content">
                                       <ul>
                                           <li>
                                                 <div class="item">
                                                    <i class="fa fa-star"></i> 4.5
                                                </div>

                                               <div class="label">Rating</div>
                                           </li>
                                           <li>
                                               <?php if (!empty($restaurant->estimated_delivery_time)) {?>
                                                   <div class="item">
                                                     <span><?=
                                                         $restaurant->estimated_delivery_time?> MINS</span>
                                                   </div>
                                                   <div class="label">Expected Delivery Time
                                                       </div>
                                               <?php }?>

                                           </li>
                                           <li>
                                               <?php if (!empty($restaurant->open_time)) {?>

                                                   <div class="item">
                                                       <span><?=
                                                           $restaurant->open_time?> - <?= $restaurant->close_time?></span>
                                                   </div>
                                                   <div class="label">Service  Timing </div>
                                               <?php }?>
                                           </li>
                                       </ul>
                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="restaurant-description">
                    <?= $restaurant->restaurant_description?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="restaurant-details">

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="container" id="form-container">
                    <div class="heading-title">
                        <h1>Menu Items</h1>
                    </div>
                    <div class="items-card mt-3">
                        <?=

                        ListView::widget([
                            'dataProvider' => $dataProvider,
                            'itemView' => '_items',
                            'summary'=>false,
                            'itemOptions' => ['class' => 'col-lg-12'],
                            'options' => [

                                'class' => 'row',
                                'id'=>false

                            ]
                        ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                    <?= $this->render('_cart')?>
            </div>

        </div>
    </div>
</div>
