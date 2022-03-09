<?php
/* @var $model \common\models\FoodItem */
$get_cart = \common\models\ItemCart::find()->where(['customer_id'=>Yii::$app->user->identity->id,'item_id'=>$model->id])->one();
if (!empty($get_cart)){
    $cart_count = $get_cart->quantity;
}
else{
    $cart_count = 0;
}
?>
<div class="result-card mb-3" id="form-container">
	<div class="row">
		<div class="col-lg-3">
		<div class="image-thumb">
			<img class="item-image" src="<?= Yii::getAlias('@web/uploads/item_images/'.$model->item_image)?>">
		</div>
		 </div>
		 <div class="col-lg-6">
		 	<div class="item-name">
		 		<?= $model->item_name?>
		 	</div>
		 	<div class="item-price">
		 		₹ <?= $model->item_price?>
		 	</div>
             <div class="restaurant-type"><?=
                 \common\models\Restaurant::getRestaurantType($model->type)?> </div>

		 </div>
		 <div class="col-lg-3">
		 	<div class="action-buttons">
                <div class="quantity buttons_added">
                <input type="number"  value="<?= $cart_count?>" min="0" id="quantity-<?=$model->id?>"
                       title="Qty"
                       class="input-text
                 qty text">
                </div>

		 	</div>

		 </div>
	</div>
</div>

<?php
$cart_url = \yii\helpers\Url::to(['cart/add-item']);
$script = <<< JS

$('#quantity-'+'$model->id').change(function(){
          var quantity = $(this).val();
          var item_id = '$model->id';
          var restaurant_id = '$model->restaurant_id';
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