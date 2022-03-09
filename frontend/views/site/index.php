<?php
use kartik\typeahead\Typeahead;
/* @var $this yii\web\View */

$this->title = 'Home | Food Delivery Service';

?>
<style>

    #banner{
        background:linear-gradient(0deg, rgba(0, 0, 0,0.5), rgba(0, 0, 0, 0.7)),url('<?=Yii::getAlias('@web/images/banner_image.jpg')?>');
        width: 100%;
        height: 600px;
        background-size: cover;
        background-position: 40% 60%;
    }
</style>
<!-- Start slides -->
<div id="banner">
    <div class="content-inner">
        <div class="banner-content">
            <div class="banner-heading"><span style="color:#d65106;">Food</span>
                <span style="color: #ffffff">Delivery</span> </div>
            <div class="banner-sub-heading">
                Discover delicious food from your nearest restaurants
            </div>

            <div class="search-form">
                <?php $form =  \yii\widgets\ActiveForm::begin(['action'=>\yii\helpers\Url::to(['site/search'])
                ]);
                    $model = new \common\models\Restaurant();
                ?>
                <div class="row">
                    <div class="col-lg-5">
                        <?=
                            $form->field($model, 'search_param_1')->widget(Typeahead::classname(), [
                            'options' => ['placeholder' => 'Search For Restaurant and Dishes','class'=>'banner-input'],
                            'pluginOptions' => ['highlight'=>true],
                            'dataset' => [
                                [
                                    'local' => \common\models\Restaurant::getBannerData(),
                                    'limit' => 10
                                ]
                            ]
                        ])->label(false)
                                                ?>
                    </div>
                    <div class="col-lg-5">
                            <?= $form->field($model,'location')->textInput
                            (['placeholder'=>'Location','style'=>'height:70px;','id'=>'location_input'])->label
                            (false)?>
                    </div>
                    <div class="col-lg-2">
                        <?= \yii\helpers\Html::submitButton('<i class="fa fa-search"></i>',
                            ['class'=>'btn 
                        btn-common',
                                'style'=>'height:70px;','id'=>'search-item-button'
                                ])?>
                    </div>
                </div>
                <?php \yii\widgets\ActiveForm::end()?>
            </div>
        </div>
    </div>
</div>
<!-- End slides -->


<!-- Start Menu -->
<div class="menu-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading-title text-center">
                    <h2>Popular Items</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                </div>
            </div>
        </div>

        <div class="row inner-menu-box">


            <div class="col-lg-12">

                        <div class="row">
                            <?php $top_items = \common\models\FoodItem::find()->where
                            (['status'=>\common\models\FoodItem::STATUS_ACTIVE])->limit(9)->all(); ?>
                            <?php foreach ($top_items as $item) {?>
                            <div class="col-lg-4 col-md-6 special-grid drinks">
                                <a href="<?= \yii\helpers\Url::to(['restaurant/details',
                                    'id'=>$item->restaurant_id])
                                ?>">
                                <div class="gallery-single fix">
                                    <img src="<?= Yii::getAlias('@web/uploads/item_images/'
                                        .$item->item_image)?>" class="home-page-item-image"
                                         alt="Image">
                                    <div class="why-text">
                                        <h4><?= $item->item_name?></h4>
                                        <p><?= $item->item_description?></p>
                                        <h5> ₹ <?= $item->item_price?></h5>
                                    </div>
                                </div>
                                </a>
                            </div>
                                    <?php }?>


                        </div>

            </div>
        </div>

    </div>
</div>
<!-- End Menu -->

<!-- Start Gallery -->
<div class="gallery-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading-title text-center">
                    <h2>Food Categories</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                </div>
            </div>
        </div>
        <div class="tz-gallery">
            <div class="row">
                <?php $categories = \common\models\Category::find()->where
                (['status'=>\common\models\Category::STATUS_ACTIVE])->limit(9)->all(); ?>
            <?php foreach ($categories as $cat) {?>
                <div class="mb-3 col-lg-4">
                    <div class="category-card">
                    <a  href="<?= \yii\helpers\Url::to(['site/search'])?>">

                           <img class="category-image" src="<?= Yii::getAlias('@web/images/img-04.jpg')?>" alt="Gallery Images">
                        <div class="category-name">
                            <?= $cat->category_name ?>
                        </div>

                    </a>
                    </div>
                </div>
            <?php }?>

            </div>
        </div>
    </div>
</div>
<!-- End Gallery -->

<!-- Start Customer Reviews -->
<div class="customer-reviews-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading-title text-center">
                    <h2>Customer Reviews</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                </div>
            </div>
        </div>
        <?php $reviews = \common\models\Review::find()->limit(6)->all();$counter = 1; ?>
        <div class="row">
            <div class="col-md-8 mr-auto ml-auto text-center">
                <div id="reviews" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner mt-4">
                        <?php foreach ($reviews as $review) { /* @var $review \common\models\Review */  ?>
                        <div class="carousel-item text-center <?php if ($counter ==1) {echo
                        "active";}?>">
                            <div class="img-box p-1 border rounded-circle m-auto">
                                <img class="d-block w-100 rounded-circle" src="<?= Yii::getAlias('@web/images/quotations-button.png')?>" alt="">
                            </div>
                            <h5 class="mt-4 mb-0"><strong class="text-warning text-uppercase"><?= \common\models\Order::getCustomerName
                                    ($review->customer_id)?></strong></h5>
                            <h6 class="text-dark m-0"><?=
                                Yii::$app->formatter->asDate($review->created_at)?></h6>
                            <p class="m-0 pt-3"><?= $review->comment?></p>
                        </div>
                        <?php $counter = $counter +1; }?>

                    </div>
                    <a class="carousel-control-prev" href="#reviews" role="button" data-slide="prev">
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#reviews" role="button" data-slide="next">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

