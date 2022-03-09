<?php

namespace frontend\controllers;


use common\models\ItemCart;
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
 * CartController implements the CRUD actions for FoodItem model.
 */
class CartController extends Controller
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
                        'actions' => ['add-item','cart-items'],
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

    public function actionAddItem(){
     $item_id = Yii::$app->request->post('item_id');
     $quantity = Yii::$app->request->post('quantity');
     $restaurant_id = Yii::$app->request->post('restaurant_id');
     $get_res_count = ItemCart::find()->where(['customer_id'=>Yii::$app->user->identity->id,
         'restaurant_id'=>$restaurant_id])->count();
     $get_all_count = ItemCart::find()->where(['customer_id'=>Yii::$app->user->identity->id])->count();
     if ($get_all_count >0 and $get_res_count == 0){
         ItemCart::deleteAll(['customer_id'=>Yii::$app->user->identity->id]);
     }


     $cart = ItemCart::find()->where(['customer_id'=>Yii::$app->user->identity->id,
         'item_id'=>$item_id])->one();
     if (empty($cart)){
        if($quantity != 0){
            $cart = new ItemCart();
            $cart->item_id  = $item_id;
            $cart->customer_id = Yii::$app->user->identity->id;
            $cart->restaurant_id = $restaurant_id;
        }
        else{
            return true;
        }

     }
     if ($quantity == 0){
         $cart->delete();
     }
     else{
         $cart->quantity = $quantity;
         $cart->save();
     }
     return true;


    }
    public function actionCartItems(){
      $cart = ItemCart::findOne(['customer_id'=>Yii::$app->user->identity->id]);
      $restaurant = Restaurant::findOne($cart->restaurant_id);
      return  $this->render('cart-item',['restaurant'=>$restaurant]);
    }
}
