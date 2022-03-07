<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "item_cart".
 *
 * @property int $id
 * @property int $item_id
 * @property int $customer_id
 * @property int $quantity
 * @property string $addedTime
 *
 * @property Customer $customer
 * @property FoodItem $item
 */
class ItemCart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'customer_id', 'quantity'], 'required'],
            [['item_id', 'customer_id', 'quantity'], 'integer'],
            [['addedTime'], 'safe'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => FoodItem::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_id' => 'Item ID',
            'customer_id' => 'Customer ID',
            'quantity' => 'Quantity',
            'addedTime' => 'Added Time',
        ];
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
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(FoodItem::className(), ['id' => 'item_id']);
    }
    public static function getTotalCarts()
    {
        $carts = ItemCart::findAll(['customer_id'=>Yii::$app->user->identity->id]);
        $count = 0;
        foreach ($carts as $cart){
            $count = $count + $cart->quantity;
        }
        return $count;
    }
    public  static  function getTotal(){
        $carts = ItemCart::findAll(['customer_id'=>Yii::$app->user->identity->id]);
        $total = 0;
        foreach ($carts as $cart){
            $item_details = \common\models\FoodItem::findOne($cart->item_id);
            $total = $total + $cart->quantity*$item_details->item_price;
        }
        return $total;
    }
}
