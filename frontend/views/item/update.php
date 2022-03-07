<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FoodItem */

$this->title = 'Update Food Item: ' . $model->item_name;

?>

<div class="site-content">
<div class="container">
	<div class="row">
		
			
		<?= $this->render('/account/sidebar.php')?>
		<div class="col-lg-9"> 
			<div class="container" id="form-container">
        <div class="heading-title">
        <h1><?= Html::encode($model->item_name) ?></h1>
        </div>
        <div class="menu-item-form">
         <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
        </div>
       
        </div>
    </div>
		</div>
	</div>
</div>
</div>