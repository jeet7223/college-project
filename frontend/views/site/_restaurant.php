<?php
/* @var $model \common\models\Restaurant */
?>
<div class="result-card mb-3" id="restaurant-container">
<a href="<?= \yii\helpers\Url::to(['restaurant/details','id'=>$model->id])?>">

        <img class="item-image" src="<?= Yii::getAlias('@web/uploads/profile_images/'
            .$model->restaurant_image)?>">
        <div class="restaurant-details">
            <div class="item-flex">
            <div class="item-name w-100">
                <?= $model->restaurant_name?>
            </div>
               <div class="w-100">
                    <span class="reviews">
                    <i class="fa fa-star"></i> 4.5
                </span>
               </div>
            </div>

                <div class="restaurant-address"><i class="fa fa-map-marker"> </i> <span><?=
                        $model->restaurant_address?>, <?= $model->city?>, <?= $model->state?></span></div>
            <div class="restaurant-type"><?=
                $model->getRestaurantType($model->restaurant_type)?> </div>
            <?php if (!empty($model->estimated_delivery_time)) {?>
            <div class="estimated-time">
               <strong>Expected Delivery Time -:</strong> <span style="color: #000000"><?=
                    $model->estimated_delivery_time?> MINS</span>
            </div>
            <?php }?>
            <?php if (!empty($model->open_time)) {?>

                <div class="estimated-time">
                    <strong>Service  Timing -:</strong> <span style="color: #000000"><?=
                        $model->open_time?> - <?= $model->close_time?></span>
                </div>
            <?php }?>
            <br>

        </div>
</a>
</div>
