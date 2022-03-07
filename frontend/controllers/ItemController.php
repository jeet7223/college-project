<?php

namespace frontend\controllers;


use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use common\models\FoodItem;
use yii\data\ActiveDataProvider;

/**

/**
 * FoodItemController implements the CRUD actions for FoodItem model.
 */
class ItemController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                 
                    [
                        'actions' => ['index','create','update','delete'],
                        'allow' => true,
                        'roles' => ['restaurant'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all FoodItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $restaurant = \common\models\Restaurant::findOne(['user_id'=>Yii::$app->user->identity->id]);
        $dataProvider = new ActiveDataProvider([
            'query' => FoodItem::find()->where(['status'=>1,'restaurant_id'=>$restaurant->id]),
            'sort'=>['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => [
                'pageSize' => 5,
            ],  
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

   

    /**
     * Creates a new FoodItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FoodItem();

        if ($model->load(Yii::$app->request->post())) {
          $restaurant = \common\models\Restaurant::findOne(['user_id'=>Yii::$app->user->identity->id]);
          $model->restaurant_id = $restaurant->id;
          $item_image = UploadedFile::getInstance($model, 'item_image');
            if($item_image){
                    $file_type = $item_image->extension;
                    $unique_name = uniqid('item_image_');
                    $file_name =  $unique_name.'.'.$file_type;
                    $file_path = 'uploads/item_images';
                    $item_image->saveAs($file_path .'/'. $file_name);
                    $model->item_image  = $file_name;
                
                  }
                  
            $model->save();
            Yii::$app->session->setFlash('success', 'Item Created Successfully');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FoodItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_image = $model->item_image;

        if ($model->load(Yii::$app->request->post()) ) {
            $item_image = UploadedFile::getInstance($model, 'item_image');
            if($item_image){
                    $file_type = $item_image->extension;
                    $unique_name = uniqid('item_image_');
                    $file_name =  $unique_name.'.'.$file_type;
                    $file_path = 'uploads/item_images';
                    $item_image->saveAs($file_path .'/'. $file_name);
                    $model->item_image  = $file_name;
                
                  }
                  else{
                    $model->item_image = $old_image;
                  }
            $model->save();
            Yii::$app->session->setFlash('success', 'Item Updated Successfully');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FoodItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Item Deleted Successfully');

        return $this->redirect(['index']);
    }

    /**
     * Finds the FoodItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FoodItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FoodItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
