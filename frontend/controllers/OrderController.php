<?php

namespace frontend\controllers;


use common\models\Customer;
use common\models\ItemCart;
use common\models\Order;
use common\models\OrderDetails;
use common\models\Restaurant;
use common\models\Review;
use frontend\models\Charge;
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
                        'actions' => ['place-order','review','charge'],
                        'allow' => true,
                        'roles' => ['customer'],
                    ],
                    [
                        'actions' => ['update-status'],
                        'allow' => true,
                        'roles' => ['restaurant'],
                    ],
                    [
                        'actions' => ['order-details'],
                        'allow' => true,
                        'roles' => ['@'],
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
        return $this->redirect(['order/order-details','order_id'=>$order->id]);
    }
    public function actionOrderDetails($order_id){
        $order = Order::findOne($order_id);
        if (empty($order)){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $restaurant = Restaurant::findOne($order->restaurant_id);
        $customer = Customer::findOne(['user_id'=>$order->customer_id]);
        $order_details = OrderDetails::findAll(['order_id'=>$order_id]);
        return $this->render('order-details',['order'=>$order,'restaurant'=>$restaurant,'customer'=>$customer,'order_details'=>$order_details]);
    }
    public function actionUpdateStatus(){
        if (Yii::$app->request->post()){
            $order = Order::findOne(Yii::$app->request->post('order_id'));
            $order->order_status = $order->order_status +1;
            $order->save();
            if ($order->order_status == Order::ORDER_STATUS_DELIVERED){
                Yii::$app->session->setFlash('success', 'Order Completed Successfully');
                return $this->redirect(['order/order-details','order_id'=>Yii::$app->request->post('order_id')]);
            }
           else{
               return true;
           }
        }
    }
    public function actionReview($order_id){
        $order = Order::findOne($order_id);
        $review = new Review();
        if ($review->load(Yii::$app->request->post())) {
            $review->order_id = $order_id;
            $review->customer_id = $order->customer_id;
            $review->restaurant_id = $order->restaurant_id;
            $review->save(false);
            Yii::$app->session->setFlash('success', 'Review Successfully');
            return $this->redirect(['order/order-details','order_id'=>$order_id]);
        }
    }
    public function actionCharge($amount){
        if (Yii::$app->request->post()){
            Charge::insertCharge($amount);
            $this->actionPlaceOrder(Order::PAYMENT_TYPE_STRIPE);
        }
    }

}
