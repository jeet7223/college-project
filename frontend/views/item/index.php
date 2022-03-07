<?php
$this->title = "Manage Menu Items";
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
use yii\widgets\ListView;
?>
<div class="site-content">
<div class="container">
	<div class="row">
		
			
		<?= $this->render('/account/sidebar.php')?>
		<div class="col-lg-9"> 
			<div class="container" id="form-container">
        <div class="heading-title">
        <h1>Manage Menu Items</h1>
        </div>
        <div class="create-button">
          <a class="btn btn-common" href="<?= Url::to(['item/create'])?>"><i class="fa fa-plus"></i> Create Item</a>
        </div>
        <div class="items-card mt-3">
        	<?=

                        ListView::widget([
                            'dataProvider' => $dataProvider,
                            'itemView' => '_items',
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
