<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $restaurant_id
 * @property int $payment_type
 * @property int $order_status
 * @property string|null $delivery_address
 * @property string $ordered_at
 *
 * @property Restaurant $restaurant
 * @property Customer $customer
 * @property OrderDetails[] $orderDetails
 */
class Order extends \yii\db\ActiveRecord
{
    const ORDER_STATUS_ACCEPT_BY_RESTAURANT = 0;
    const ORDER_STATUS_PREPARING = 1;
    const ORDER_STATUS_PREPARED = 2;
    const ORDER_STATUS_OUT_FOR_DELIVERY = 3;
    const ORDER_STATUS_DELIVERED = 4;
    const PAYMENT_TYPE_CASH_ON_DELIVERY = 0;
    const PAYMENT_TYPE_STRIPE = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'restaurant_id', 'payment_type', 'order_status'], 'required'],
            [['customer_id', 'restaurant_id', 'payment_type', 'order_status'], 'integer'],
            [['delivery_address'], 'string'],
            [['ordered_at'], 'safe'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'restaurant_id' => 'Restaurant ID',
            'payment_type' => 'Payment Type',
            'order_status' => 'Order Status',
            'delivery_address' => 'Delivery Address',
            'ordered_at' => 'Ordered At',
        ];
    }

    /**
     * Gets query for [[Restaurant]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::className(), ['id' => 'restaurant_id']);
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * Gets query for [[OrderDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetails::className(), ['order_id' => 'id']);
    }
    public static  function getRestaurantName($id){
        $restaurant = Restaurant::findOne($id);
        return $restaurant->restaurant_name;
    }
    public static  function getCustomerName($id){
        $customer = Customer::findOne(['user_id'=>$id]);
        return $customer->customer_first_name." ".$customer->customer_last_name;
    }
    public static function getTotalCarts($id)
    {
        $carts = OrderDetails::findAll(['order_id'=>$id]);
        $count = 0;
        foreach ($carts as $cart){
            $count = $count + $cart->quantity;
        }
        return $count;
    }
    public static function getTotalAmount($id){
        $carts = OrderDetails::findAll(['order_id'=>$id]);
        $total = 0;
        foreach ($carts as $cart){
            $item_details = \common\models\FoodItem::findOne($cart->item_id);

            $total = $total + $cart->quantity*$item_details->item_price;
        }
        return $total;
    }
    public static function getOrderStatus($status){
        if ($status == 0){
            return "Order Accepted By Restaurant";
        }
        elseif ($status == 1){
            return "Order has been preparing";
        }
        elseif ($status == 2){
            return "Order has been prepared";
        }
        elseif ($status == 3){
            return "Out for delivery";
        }
        elseif ($status == 4){
            return "Delivered";
        }
        else{
            return "Invalid Status";
        }
    }
    public static function getPaymentMethod($method){
        if ($method == self::PAYMENT_TYPE_CASH_ON_DELIVERY){
            return "Cash On Delivery";
        }
        elseif ($method == self::PAYMENT_TYPE_STRIPE){
            return "Stripe";
        }
        else{
            return "Invalid";
        }
    }

}
