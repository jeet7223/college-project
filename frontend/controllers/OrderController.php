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


class OrderController extends Controller
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
                        'actions' => ['place-order'],
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
    public function actionPlaceOrder($payment_method){

        $cart_all = ItemCart::findAll(['customer_id'=>Yii::$app->user->identity->id]);
        $cart_one = ItemCart::findOne(['customer_id'=>Yii::$app->user->identity->id]);
        if (empty($cart_one)){
            Yii::$app->session->setFlash('error', 'Add items to the cart to place order');
            return $this->redirect(['cart/cart-items']);
        }
        $customer =  Customer::findOne(['user_id'=>Yii::$app->user->identity->id]);
        $order = new Order();
        $order->customer_id = Yii::$app->user->identity->id;
        $order->restaurant_id = $cart_one->restaurant_id;
        $order->payment_type = $payment_method;
        $order->order_status = Order::ORDER_STATUS_ACCEPT_BY_RESTAURANT;
        $order->delivery_address = $customer->customer_address;
        $order->save();
        foreach ($cart_all as $cart){
            $order_details = new OrderDetails();
            $order_details->order_id = $order->id;
            $order_details->item_id = $cart->item_id;
            $order_details->quantity = $cart->quantity;
            $order_details->save();
        }
        ItemCart::deleteAll(['customer_id'=>Yii::$app->user->identity->id]);
        Yii::$app->session->setFlash('success', 'Order Placed Successfully');
        return $this->redirect(['cart/cart-items']);
    }


}
