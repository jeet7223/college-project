
<div class="col-lg-3">	
  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link <?php if (Yii::$app->controller->id == 'account' and
                    Yii::$app->controller->action->id == 'edit-profile') { echo "active";}?>" href="<?= yii\helpers\Url::to(['account/edit-profile'])?>" ><i class="fa
                                fa-edit"></i> Edit Profile</a>
                                <?php if(Yii::$app->user->can('restaurant')){?>
                                	 <a class="nav-link <?php if (Yii::$app->controller->id == 'item') { echo "active";}?>" href="<?= yii\helpers\Url::to(['/item'])?>" ><i class="fa
                                fa-list"></i> Menu Items</a>
                                <?php }?>
      <?php if(Yii::$app->user->can('customer')){?>
          <a class="nav-link <?php if (Yii::$app->controller->id == 'cart') { echo "active";}?>"
             href="<?= yii\helpers\Url::to(['cart/cart-items'])?>" ><i class="fa
                                fa-shopping-cart"></i> Cart Items</a>
      <?php }?>
      <?php if(Yii::$app->user->can('customer')){?>
          <a class="nav-link <?php if (Yii::$app->controller->id == 'my-orders') { echo "active";
          }?>"
             href="<?= yii\helpers\Url::to(['my-orders/index'])?>" ><i class="fa
                                fa-shopping-bag"></i> My Orders</a>
      <?php }?>
      <?php if(Yii::$app->user->can('restaurant')){?>
          <a class="nav-link <?php if (Yii::$app->controller->id == 'received-orders') { echo "active";
          }?>"
             href="<?= yii\helpers\Url::to(['received-orders/index'])?>" ><i class="fa
                                fa-shopping-bag"></i> Received Orders</a>
      <?php }?>
                  	 <?=
                                yii\helpers\Html::a(
                                    '<i class="fa fa-sign-out"></i> Logout',
                                    \yii\helpers\Url::to(['site/logout']),
                                    ['class' => 'nav-link','data-method' => 'POST']
                                )
                                ?>
                </div>
                </div>