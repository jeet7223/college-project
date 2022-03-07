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
		 	<div class="category">
		 		<strong>Category -: </strong> <span style="color: #d65106"><?= $model->getCategory($model->category)?></span>
		 	</div>
		 	<div class="sub-category">
		 		<strong>Sub Category -: </strong> <span style="color: #d65106"><?= $model->getSubCategory($model->subcategory)?></span>
		 	</div>
		 </div>
		 <div class="col-lg-3">
		 	<div class="action-buttons">
		 		<a class="btn btn-common rounded-circle action" data-toggle="collapse" href="#collapse-<?= $model->id?>" role="button" aria-expanded="false" aria-controls="collapse-<?= $model->id?>"><i class="fa fa-eye"></i></a>
		 		<a class="btn btn-common rounded-circle action" href="<?= yii\helpers\Url::to(['item/update','id'=>$model->id])?>"><i class="fa fa-edit"></i></a>
		 		<a class="btn btn-common rounded-circle action" href="<?= yii\helpers\Url::to(['item/delete','id'=>$model->id]) ?>" onclick="return confirm('Are you sure you want to delete this item?');" data-method="POST"><i class="fa fa-trash"></i></a>
		 	</div>

		 </div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="collapse" id="collapse-<?= $model->id?>">
				<h2>Item Description -:</h2>
		 	 	<div class="item-description"><?= $model->item_description?></div>
		 	 </div>
		</div>
	</div>
</div>
