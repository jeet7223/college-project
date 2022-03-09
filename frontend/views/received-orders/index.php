<?php

use yii\widgets\ListView;

$this->title  = "My Orders"
/* @var $dataProvider \common\models\Order */
?>
<div class="site-content">
    <div class="container">
        <div class="row">


            <?= $this->render('/account/sidebar.php')?>
            <div class="col-lg-9">
                <div class="container" id="form-container">
                    <div class="heading-title">
                        <h1>Received Orders</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="items-card mt-3">
                                <?=

                                ListView::widget([
                                    'dataProvider' => $dataProvider,
                                    'itemView' => '_orders',
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
                </div>
            </div>
        </div>
    </div>
</div>
