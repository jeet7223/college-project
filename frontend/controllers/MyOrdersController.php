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


class MyOrdersController extends Controller
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
                        'roles' => ['customer'],
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
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find()->where(['customer_id'=>Yii::$app->user->identity->id]),
            'sort'=>['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }

}
