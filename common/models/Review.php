<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id
 * @property int $order_id
 * @property int $restaurant_id
 * @property int $customer_id
 * @property string $rating
 * @property string $comment
 * @property string $created_at
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'rating', 'comment'], 'required'],
            [['order_id', 'restaurant_id', 'customer_id'], 'integer'],
            [['created_at','order_id', 'restaurant_id', 'customer_id'], 'safe'],
            [['rating'], 'string', 'max' => 10],
            [['comment'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'restaurant_id' => 'Restaurant ID',
            'customer_id' => 'Customer ID',
            'rating' => 'Rating',
            'comment' => 'Comment',
            'created_at' => 'Created At',
        ];
    }
}
