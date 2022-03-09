<?php
/* @var $restaurant \common\models\Restaurant */

use miloschuman\highcharts\Highcharts;

$this->title = 'Dashboard | '.$restaurant->restaurant_name;
$total_orders = \common\models\Order::find()->where(['restaurant_id'=>$restaurant->id])->count();
$total_menu_items = \common\models\FoodItem::find()->where(['restaurant_id'=>$restaurant->id])->count();
$total_review = \common\models\Review::find()->where(['restaurant_id'=>$restaurant->id])->count();
?>
<div class="site-content">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">



                    <div class="restaurant-cart-section">
                        <div class="container" id="form-container">
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
                                        <div class="row">
                                            <div class="col-lg-6">
                                        <div class="restaurant-address dashboard-sub-text"><i
                                                    class="fa
                                        fa-map-marker"> </i> <span><?=
                                                $restaurant->restaurant_address?>, <?= $restaurant->city?>, <?=
                                                $restaurant->state?></span></div>
                                        <div class="restaurant-number dashboard-sub-text">
                                            <i class="fa fa-phone"></i> <?=
                                            $restaurant->restaurant_contact_number?>
                                        </div>
                                        <div class="restaurant-email dashboard-sub-text">
                                            <i class="fa fa-envelope"></i> <?=
                                            Yii::$app->user->identity->email?>
                                        </div>

                                            </div>
                                            <div class="col-lg-6">
                                                <div class="dashboard-sub-text"><strong><i class="fa fa-calendar"></i> Registered At-:</strong> <span><?= Yii::$app->formatter->asDate(Yii::$app->user->identity->created_at)?></span></div>
                                                <div class="restaurant-type"><?=
                                                    $restaurant->getRestaurantType($restaurant->restaurant_type)
                                                    ?> </div>
                                                <?php if (!empty($restaurant->estimated_delivery_time)) {?>
                                                    <div class="estimated-time">
                                                        <strong>Expected Delivery Time -:</strong> <span style="color: #000000"><?=
                                                            $restaurant->estimated_delivery_time?> MINS</span>
                                                    </div>
                                                <?php }?>
                                                <?php if (!empty($restaurant->open_time)) {?>

                                                    <div class="estimated-time">
                                                        <strong>Service  Timing -:</strong> <span style="color: #000000"><?=
                                                            $restaurant->open_time?> - <?= $restaurant->close_time?></span>
                                                    </div>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="cards-section">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="insight-card">
                                    <div class="value">
                                        <i class="fa fa-shopping-bag"></i>  <?= $total_orders?>
                                    </div>
                                    <div class="label">Total Orders</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="insight-card">
                                    <div class="value">
                                    <i class="fa fa-list"></i>     <?= $total_menu_items?>
                                    </div>
                                    <div class="label">Total Menu Items</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="insight-card">
                                    <div class="value">
                                       <i class="fa fa-star"></i> <?= round
                                        ($restaurant->getAverageRating
                                        ($restaurant->id),1)?> / 5
                                    </div>
                                    <div class="label">Total Reviews (<?= $total_review?> Reviews)
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="insight-card">
                                    <div class="value">
                                        <i class="fa fa-rupee"></i> <?=
                                        $restaurant->getTotalIncome($restaurant->id)?>
                                    </div>
                                    <div class="label">Total Income
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="graph">
                    <div class="container" id="form-container">
                         <?=

                        Highcharts::widget([
                            'options' => [
                                'title' => ['text' => 'Income Graph'],
                                'chart'=>[
                                    'type'=>'column'
                                ],
                                'xAxis' => array(
                                    'categories' => array('Income in ₹')
                                ),
                                'series' =>[
                                        ['name' => 'January', 'data' => [2000]],
                                        ['name' => 'February', 'data' => [1500]],
                                        ['name' => 'March', 'data' => [5000]],
                                ]
                            ]
                        ]);
                        ?>
                    </div>
                </div>




            </div>
        </div>
    </div>
</div>