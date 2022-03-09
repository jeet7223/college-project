<?php use yii\widgets\Pjax;
$cart = \common\models\ItemCart::find()->where
(['customer_id'=>Yii::$app->user->identity->id])->count();
$cart_items = \common\models\ItemCart::getTotalCarts();
$user_carts = \common\models\ItemCart::find()->where
(['customer_id'=>Yii::$app->user->identity->id])->all();
Pjax::begin(['id' => 'cart-pjax']);?>
<?php if ($cart > 0) {?>
    <div class="container" id="form-container">
        <div class="heading-title">
            <h1>Cart</h1>
            <div class="total-carts"><?= $cart_items?> ITEMS</div>
        </div>
        <div class="cart-details">
            <?php foreach ($user_carts as $carts) {?>
                    <?php $item_details = \common\models\FoodItem::findOne($carts->item_id)?>
                <div class="cart-items">
                    <div class="food-item-name"><?= $item_details->item_name?></div>
                    <div class="item-quantity"><?= $carts->quantity ." X".
                        " ₹".  $item_details->item_price ." = "?> <span style="color: #000000"><?= "₹"
                            .$carts->quantity*$item_details->item_price?></span> </div>
                </div>
            <?php }?>
        </div>
        <div class="footer-content mt-3">
            <div class="flex-content">
                <span class="subtotal">Subtotal</span>
                <div class="w-100">
                    <span class="total-value">₹ <?= \common\models\ItemCart::getTotal()?></span>
                </div>
            </div>
        </div>
        <div class="checkout-button">
            <a href="<?= \yii\helpers\Url::to(['cart/cart-items'])?>" class="btn btn-common
        w-100" data-pjax="0">Checkout
                <i class="fa fa-arrow-right"></i>
            </a>
        </div>
    </div>
<?php }?>
<?php Pjax::end()?>