<?php

namespace frontend\controllers;


use common\models\Restaurant;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use common\models\FoodItem;
use yii\data\ActiveDataProvider;

/**

/**
 * FoodItemController implements the CRUD actions for FoodItem model.
 */
class RestaurantController extends Controller
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
                        'actions' => ['details'],
                        'allow' => true,
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

    public function actionDetails($id){
        $restaurant = Restaurant::findOne($id);
        if (empty($restaurant)){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = new ActiveDataProvider([
            'query' => FoodItem::find()->where(['status'=>1,'restaurant_id'=>$id]),
            'sort'=>['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('details',['restaurant'=>$restaurant,'dataProvider'=>$dataProvider]);
    }
}
