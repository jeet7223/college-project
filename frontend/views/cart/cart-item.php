<?php use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
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

                <?php if ($cart > 0) {?>
                    <div class="container" id="form-container">
                        <div class="heading-title">
                            <h1>Cart Items</h1>
                            <div class="total-carts"><?= $cart_items?> ITEMS</div>
                        </div>
                        <?php Pjax::begin(['id' => 'cart-pjax']);?>
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
                                        <div class="col-lg-6">
                                            <div class="food-item-name"><?= $item_details->item_name?></div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="item-quantity"><?= $carts->quantity ." X".
                                                " ₹".  $item_details->item_price ." = "?> <span style="color: #000000"><?= "₹"
                                                    .$carts->quantity*$item_details->item_price?></span> </div>
                                        </div>

                                    </div>


                                </div>

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



                        <?php Pjax::end()?>
                    <div class="checkout-button">
                        <?php $form = ActiveForm::begin(['action'=>\yii\helpers\Url::to(['order/charge','amount'=>\common\models\ItemCart::getTotal()]),'options'
                        => ['method' => 'post']]); ?>

                        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="pk_test_51H2GVPHzcrWIwyYMmoxuwOpsMkzMyKXo4RIBFWIcFuhRhdF9QadtWsWwZ3PvyeAAjM2P8MS2ilk9tOdWAnncaiQ400KviVO2AY"
                                data-name="Food Delivery"
                                data-description="Order Food Online"
                                data-currency=inr
                                data-amount=<?= \common\models\ItemCart::getTotal() * 100?>
                                data-locale="auto">

                        </script>
                        <?php ActiveForm::end(); ?>
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

            </div>
        </div>
    </div>
</div>