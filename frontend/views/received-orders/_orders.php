<?php
/* @var $model \common\models\Order */
?>

<div class="order-card mb-3" id="form-container">
    <div class="order-grid">
    <div class="row">
        <div class="col-lg-4">
            <div class="restaurant-name"><?= $model->getCustomerName($model->customer_id) ?></div>
            <div class="total-carts"><?= $model->getTotalCarts($model->id)?> ITEMS</div>
            <span class="total-value">₹ <?= $model->getTotalAmount($model->id)?></span>

        </div>
        <div class="col-lg-8">
            <div class="d-lg-flex">
               <div class="content-section-secondary">
                   <div class="ordered-at"><strong>Ordered At -: </strong> <?=
                       Yii::$app->formatter->asDate($model->ordered_at)?></div>
                   <div class="ordered-sttaus"><strong>Order Status -: </strong> <?=
                   $model->getOrderStatus($model->order_status)?></div>

               </div>
            </div>
        </div>
        <div class="w-100">
            <div class="mt-3 float-left">
                <a href="<?= \yii\helpers\Url::to(['order/order-details','order_id'=>$model->id])
                ?>"
                   class="btn
                btn-common">Order
                    Details</a>
            </div>
        </div>

        </div>
    </div>

</div>