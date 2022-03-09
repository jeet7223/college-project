<?php use yii\widgets\Pjax;
$this->title = "Your Cart Items";
$cart = \common\models\ItemCart::find()->where
(['customer_id'=>Yii::$app->user->identity->id])->count();
$cart_items = \common\models\ItemCart::getTotalCarts();
$user_carts = \common\models\ItemCart::find()->where
(['customer_id'=>Yii::$app->user->identity->id])->all();
$get_cart = \common\models\ItemCart::find()->where(['customer_id'=>Yii::$app->user->identity->id,'item_id'=>$model->id])->one();
if (!empty($get_cart)){
    $cart_count = $get_cart->quantity;
}
else{
    $cart_count = 0;
}
/* @var $restaurant \common\models\Restaurant */
?>
<div class="site-content">
    <div class="container">
        <div class="row">


            <?= $this->render('/account/sidebar.php')?>
            <div class="col-lg-9">
               <?php Pjax::begin(['id' => 'cart-pjax']);?>
                <?php if ($cart > 0) {?>
                    <div class="container" id="form-container">
                        <div class="heading-title">
                            <h1>Cart Items</h1>
                            <div class="total-carts"><?= $cart_items?> ITEMS</div>
                        </div>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cart-details">
                            <?php foreach ($user_carts as $carts) {?>
                                <?php /* @var  $carts \common\models\ItemCart */?>
                                <?php $item_details = \common\models\FoodItem::findOne($carts->item_id)?>
                                    <?php $get_cart = \common\models\ItemCart::find()->where(['customer_id'=>Yii::$app->user->identity->id,'item_id'=>$item_details->id])->one();
                                if (!empty($get_cart)){
                                    $cart_count = $carts->quantity;
                                }
                                else{
                                    $cart_count = 0;
                                }
                                ?>
                                <div class="cart-items">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="food-item-name"><?= $item_details->item_name?></div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="item-quantity"><?= $carts->quantity ." X".
                                                " ₹".  $item_details->item_price ." = "?> <span style="color: #000000"><?= "₹"
                                                    .$carts->quantity*$item_details->item_price?></span> </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="quantity buttons_added">
                                                <input type="number"  value="<?= $cart_count?>" min="0" id="quantity-<?=$item_details->id?>"
                                                       title="Qty"
                                                       class="input-text qty text">
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <?php
                                $cart_url = \yii\helpers\Url::to(['cart/add-item']);
                                $script = <<< JS

                                    $('#quantity-'+'$item_details->id').change(function(){
                                              var quantity = $(this).val();
                                              var item_id = '$item_details->id';
                                              var restaurant_id = '$carts->restaurant_id';
                                              $.ajax({
                                                    type: "POST",
                                                    url: "$cart_url",
                                                    data: {quantity: quantity,item_id:item_id,restaurant_id:restaurant_id},
                                                    success: function (data) {
                                                        $.pjax.reload({container: '#cart-pjax', async: false});
                                                    },
                                                    error: function (exception) {
                                                        console.log("Unsuccesfull");
                                                    }
                                                })
                                    })
JS;
                                $this->registerJs($script);
                                ?>
                            <?php }?>
                        </div>
                        <div class="footer-content mt-3">
                            <div class="cart-customer">
                                <div class="subtotal">Subtotal</div>
                                <div class="w-100">
                                    <span class="total-value">₹ <?= \common\models\ItemCart::getTotal()?></span>
                                </div>
                            </div>
                        </div>
                        <div class="checkout-button">
                            <a href="<?= \yii\helpers\Url::to(['order/place-order','payment_method'=>\common\models\Order::PAYMENT_TYPE_CASH_ON_DELIVERY])
                            ?>"
                               class="btn
                            btn-common
        w-50"> Place Order</a>
                        </div>
                    </div>
                <?php }else{?>
                <div class="container" id="form-container">
                    <div class="heading-title">
                        <h1>Cart Items</h1>

                    </div>
                    <div class="message mt-3">
                        <h3>No Cart Item Found</h3>
                    </div>
                </div>
                <?php }?>
                <?php Pjax::end()?>
            </div>
        </div>
    </div>
</div>