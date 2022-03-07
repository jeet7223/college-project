<?php

use yii\helpers\Html;

?>
<!--Header Start-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand site-logo" href="<?=
            \yii\helpers\Url::to(['/'])
            ?>">
               Food Delivery
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-rs-food" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbars-rs-food">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?php if (Yii::$app->controller->id == 'site' and
                    Yii::$app->controller->action->id == 'index') { echo "active";}?>"><a
                                class="nav-link"
                                                          href="<?=
                                                          \yii\helpers\Url::to(['/'])
                                                          ?>">Home</a></li>
                    <li class="nav-item <?php if (Yii::$app->controller->id == 'site' and
                        Yii::$app->controller->action->id == 'about') { echo "active";}?>"><a class="nav-link "
                                            href="<?= \yii\helpers\Url::to(['site/about'])
                                            ?>">About</a></li>


                    <li class="nav-item <?php if (Yii::$app->controller->id == 'site' and
                        Yii::$app->controller->action->id == 'contact') { echo "active";}?>"><a
                                class="nav-link" href="<?= \yii\helpers\Url::to(['site/contact'])
                        ?>">Contact</a></li>
                    <?php if (Yii::$app->user->isGuest) {?>
                        <li class="nav-item <?php if (Yii::$app->controller->id == 'site' and
                            Yii::$app->controller->action->id == 'login') { echo "active";}?>"><a
                                    class="nav-link" href="<?=
                            \yii\helpers\Url::to(['site/login'])?>">Login</a></li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown-a"
                               data-toggle="dropdown">Register</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-a">

                                <a class="dropdown-item" href="<?=
                                \yii\helpers\Url::to(['signup/customer'])?>"><i class="fa
                                fa-user"></i> Customer</a>
                                <a class="dropdown-item" href="<?=
                                \yii\helpers\Url::to(['signup/restaurant'])?>"><i class="fa
                                fa-cutlery"></i> Restaurant</a>
                            </div>
                        </li>
                    <?php }else {?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown-a"
                               data-toggle="dropdown"><i class="fa fa-user"> </i> <?=
                                Yii::$app->user->identity->username?></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-a">
                                <?=
                                Html::a(
                                    '<i class="fa fa-sign-out"></i> Logout',
                                    \yii\helpers\Url::to(['site/logout']),
                                    ['class' => 'dropdown-item','data-method' => 'POST']
                                )
                                ?>
                                <a class="dropdown-item" href="<?= yii\helpers\Url::to(['account/edit-profile'])?>"><i class="fa
                                fa-edit"></i> Account</a>
                            </div>
                        </li>
                    <?php }?>

                </ul>
            </div>
        </div>
    </nav>
<!--Header End-->