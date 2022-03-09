<?php use kartik\rating\StarRating;
use yii\widgets\Pjax;
$this->title = "Order Details";

/* @var $order \common\models\Order */
/* @var $restaurant \common\models\Restaurant */
/* @var $customer \common\models\Customer */
/* @var $order_details \common\models\OrderDetails */
$review_count = \common\models\Review::find()->where(['order_id'=>$order->id])->count();
?>
<div class="site-content">

    <div class="container">
        <div class="row">
            <div class="col-lg-8">


                <div class="container" id="form-container">
                 <?php if (Yii::$app->user->can('customer')){?>
                     <div class="restaurant-cart-section">
                         <div class="d-lg-flex">
                             <div class="image-thumb">
                                 <img class="restaurant-image" src="<?= Yii::getAlias('@web/uploads/profile_images/'
                                     .$restaurant->restaurant_image)?>">
                             </div>
                             <div class="restaurant-details-cart">
                                 <div class="row">
                                     <div class="col-lg-12">
                                         <div class="item-name">
                                             <?= $restaurant->restaurant_name?>
                                         </div>

                                         <div class="restaurant-address"><i class="fa fa-map-marker"> </i> <span><?=
                                                 $restaurant->restaurant_address?>, <?= $restaurant->city?>, <?=
                                                 $restaurant->state?></span></div>


                                         <div class="payment-method">
                                             <?= \common\models\Order::?>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                    <?php }?>
                    <?php if (Yii::$app->user->can('restaurant')){?>
                    <div class="order-grid">
                        <div class="item-name">
                            <?= $customer->customer_first_name." ".$customer->customer_last_name?>
                        </div>

                        <div class="restaurant-address"><i class="fa fa-map-marker"> </i> <span><?=
                                $customer->customer_address?></span></div>
                    </div>
                    <?php }?>
                    <?php Pjax::begin(['id' => 'order-details-section-one']);?>
                    <div class="status-section mt-5">
                        <div class="status  <?php if($order->order_status >= 
                            \common\models\Order::ORDER_STATUS_ACCEPT_BY_RESTAURANT ){ echo "completed"; }?>">
                            <?php if($order->order_status >= \common\models\Order::ORDER_STATUS_ACCEPT_BY_RESTAURANT ){ echo '<i class="fa fa-check-circle"></i>'; } else{ echo '<i class="far fa-circle-o"></i>'; }?>

                            <div><?= Yii::t('app','Order Accepted By Restaurant')?>
                                <div class="message">
                                   Your order has been  accepted by restaurant
                                </div>
                            </div>


                        </div>
                        <div class="status  <?php if($order->order_status >= \common\models\Order::ORDER_STATUS_PREPARING ){ echo "completed"; }?>">
                            <?php if($order->order_status >= \common\models\Order::ORDER_STATUS_PREPARING ){ echo '<i class="fa fa-check-circle"></i>'; } else{ echo '<i class="fa fa-circle-o"></i>'; }?>
                            <div><?= Yii::t('app','Order Preparing')?>
                                <div class="message">
                                    Your order has been preparing
                                </div>
                            </div>


                        </div>
                        <div class="status  <?php if($order->order_status >=
                            \common\models\Order::ORDER_STATUS_PREPARED ){ echo "completed"; }?>">
                            <?php if($order->order_status >= 
                                \common\models\Order::ORDER_STATUS_PREPARED ){ echo '<i class="fa fa-check-circle"></i>'; } else{ echo '<i class="fa fa-circle-o"></i>'; }?>
                            <div><?= Yii::t('app','Order Has Been Prepared')?>
                                <div class="message">
                                    Your order has been prepared
                                </div>
                            </div>


                        </div>
                        <div class="status  <?php if($order->order_status >=
                            \common\models\Order::ORDER_STATUS_OUT_FOR_DELIVERY ){ echo "completed"; }?>">
                            <?php if($order->order_status >= \common\models\Order::ORDER_STATUS_OUT_FOR_DELIVERY ){ echo '<i class="fa fa-check-circle"></i>'; } else{ echo '<i class="fa fa-circle-o"></i>'; }?>
                            <div><?= Yii::t('app','Out For Delivery')?>
                                <div class="message">
                                    Your order is out for delivery and reach to you successfully
                                </div>
                            </div>


                        </div>


                        <div class="status  <?php if($order->order_status >=
                            \common\models\Order::ORDER_STATUS_DELIVERED ){ echo "completed"; }?>">
                            <?php if($order->order_status >= \common\models\Order::ORDER_STATUS_DELIVERED ){ echo '<i class="fa fa-check-circle"></i>'; } else{ echo '<i class="fa fa-circle-o"></i>'; }?>
                            <div><?= Yii::t('app','Delivered')?>
                                <div class="message">
                                   Order has successfully delivered to his destination
                                </div>
                            </div>


                        </div>


                    </div>
                    <?php Pjax::end()?>
                </div>


            </div>
            <div class="col-lg-4">

                <div class="container" id="form-container">
                    <div class="order-details-sidebar">
                        <div class="heading-title">
                            Order Details
                        </div>
                        <div class="total-carts"><?= $order->getTotalCarts($order->id)?> ITEMS</div>
                    </div>
                    <br>




                    <div class="cart-details">
                        <?php foreach ($order_details as $details) {?>
                            <?php /* @var $details \common\models\OrderDetails */ ?>
                            <?php $item_details = \common\models\FoodItem::findOne($details->item_id)?>
                            <div class="cart-items">
                                <div class="food-item-name"><?= $item_details->item_name?></div>
                                <div class="item-quantity"><?= $details->quantity ." X".
                                    " ₹".  $item_details->item_price ." = "?> <span style="color: #000000"><?= "₹"
                                        .$details->quantity*$item_details->item_price?></span> </div>
                            </div>
                        <?php }?>
                    </div>
                    <div class="footer-content mt-3">
                        <div class="flex-content">
                            <span class="subtotal">Subtotal</span>
                            <div class="w-100">
                                <span class="total-value">₹ <?= $order->getTotalAmount($order->id)
                                    ?></span>
                            </div>
                        </div>
                    </div>

                </div>
                <br>
                <?php if($order->order_status  < \common\models\Order::ORDER_STATUS_DELIVERED and
                    Yii::$app->user->can('restaurant')){
                    ?>
                    <div class="container" id="form-container">



                            <div class="order-details-sidebar">
                                <div class="heading-title">
                                    Update Delivery Status
                                </div>
                            </div>
                        <br>
                            <div class="order-status-card">
                                <?php Pjax::begin(['id' => 'order-details-section-two']);?>
                                        <div class="current-status">
                                            <i class="fa fa-check-circle" style="color: green"></i>
                                            <span class="order-status"><?=  $order->getOrderStatus
                                                ($order->order_status)?></span>
                                        </div>
                                <div class="current-status">
                                    <i class="fa fa-clock-o" style="color: orange"></i>
                                    <span class="order-status"><?=  $order->getOrderStatus
                                        ($order->order_status + 1)?></span>
                                </div>
                                <?php Pjax::end()?>

                                        <button class="btn btn-common"
                                                id="update-status" data-pjax="0">Update
                                            Status</button>


                            </div>


                    </div>
                <?php }?>
            </div>
        </div>
        <?php if (Yii::$app->user->can('customer') and $order->order_status ==
            \common\models\Order::ORDER_STATUS_DELIVERED and $review_count == 0) {?>
                <br>
        <div class="row">
            <div class="col-lg-8">
                <div class="container" id="form-container">
                    <div class="heading-title">
                        <h1>Review</h1>
                    </div>
                    <?php $review = new \common\models\Review();?>
                    <?php $form  = \yii\bootstrap\ActiveForm::begin
                    (['action'=>\yii\helpers\Url::to(['order/review','order_id'=>$order->id])])?>
                    <div class="row">
                        <div class="col-lg-12">
                            <?= $form->field($review,'rating')->widget(StarRating::className(),[

                            ])?>

                        </div>
                        <div class="col-lg-12">
                            <?= $form->field($review,'comment')->textarea()?>
                        </div>
                        <div class="col-lg-12">
                          <?= \yii\helpers\Html::submitButton('Save',['class'=>'btn btn-common'])?>
                        </div>
                    </div>
                    <?php \yii\bootstrap\ActiveForm::end()?>
                </div>
            </div>
        </div>
      <?php }?>
    <?php if ($order->order_status ==\common\models\Order::ORDER_STATUS_DELIVERED and
    $review_count == 1) {?>
        <br>
        <div class="row">
            <div class="col-lg-8">
                <div class="container" id="form-container">
                    <div class="heading-title">
                        <h1>Review on this order</h1>
                    </div>
                    <?php $review = \common\models\Review::findOne(['order_id'=>$order->id]);?>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="customer-name">
                                <i class="fa fa-user"></i>  <?= \common\models\Order::getCustomerName
                                  ($review->customer_id)?>
                            </div>
                            <div class="reviewed-at">
                                <?= Yii::$app->formatter->asDate($review->created_at)?>
                            </div>
                        </div>
                        <div class="col-lg-12">

                            <?=
                             StarRating::widget([
                                'name' => 'rating',
                                'value' => $review->rating,
                                'pluginOptions' => ['displayOnly' => true]
                            ]);
                            ?>
                        </div>
                        <div class="col-lg-12">
                         <div class="comment">
                             <?= $review->comment?>
                         </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php }?>
    </div>

</div>
<?php
$status_url = \yii\helpers\Url::to(['order/update-status']);
$script = <<< JS

$('#update-status').click(function(){
  var order_id = '$order->id';
  $.ajax({
        type: "POST",
        url: "$status_url",
        data: {order_id:order_id},
        success: function (data) {
            $.pjax.reload({container: '#order-details-section-two', 
            async: 
            false});
             $.pjax.reload({container: '#order-details-section-one', 
            async: 
            false});
        },
        error: function (exception) {
            console.log("Unsuccesfull");
        }
    })
})
JS;
$this->registerJs($script);
?>