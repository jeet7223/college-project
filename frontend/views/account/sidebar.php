
<div class="col-lg-3">	
  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link <?php if (Yii::$app->controller->id == 'account' and
                    Yii::$app->controller->action->id == 'edit-profile') { echo "active";}?>" href="<?= yii\helpers\Url::to(['account/edit-profile'])?>" ><i class="fa
                                fa-edit"></i> Edit Profile</a>
                                <?php if(Yii::$app->user->can('restaurant')){?>
                                	 <a class="nav-link <?php if (Yii::$app->controller->id == 'item') { echo "active";}?>" href="<?= yii\helpers\Url::to(['/item'])?>" ><i class="fa
                                fa-list"></i> Menu Items</a>
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