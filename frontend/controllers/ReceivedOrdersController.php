<?php

namespace frontend\controllers;


use common\models\Customer;
use common\models\ItemCart;
use common\models\Order;
use common\models\OrderDetails;
use common\models\Restaurant;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use common\models\FoodItem;
use yii\data\ActiveDataProvider;


class ReceivedOrdersController extends Controller
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
                        'actions' => ['index'],
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
    public function actionIndex(){
        $restaurant = Restaurant::findOne(['user_id'=>Yii::$app->user->identity->id]);
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find()->where(['restaurant_id'=>$restaurant->id]),
            'sort'=>['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }

}
