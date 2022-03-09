<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "restaurant".
 *
 * @property int $id
 * @property int $user_id
 * @property string $restaurant_name
 * @property string $restaurant_address
 * @property string $restaurant_contact_number
 * @property string|null $restaurant_image
 * @property string $city
 * @property string $state
 * @property string $restaurant_description
 * @property int $restaurant_status
 * @property string $estimated_delivery_time
 * @property  string $open_time
 * * @property  string close_time
 * @property  integer $restaurant_type
 */
class Restaurant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'restaurant';
    }
    public $search_param_1;
    public $location;
    public $category;
    public $sub_category;
    const SCENARIO_SEARCH = 'search';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'restaurant_name', 'restaurant_address', 'restaurant_contact_number', 'city', 'state', 'restaurant_description'], 'required'],
            [['user_id', 'restaurant_status','restaurant_type'], 'integer'],
            [['estimated_delivery_time'],'integer','min'=>5,'max'=>150],
            [['restaurant_address', 'restaurant_description','open_time','close_time'], 'string'],
            [['restaurant_name','city', 'state'], 'string', 'max' => 100],
            [['restaurant_contact_number','search_param_1','location' ], 'string', 'max' => 50],
            [['restaurant_image'], 'string', 'max' => 255],
            [['open','close'],'safe'],
            [['search_param_1','location','restaurant_type','category','sub_category'],
                'required','on'=>self::SCENARIO_SEARCH]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'restaurant_name' => 'Restaurant Name',
            'restaurant_address' => 'Restaurant Address',
            'restaurant_contact_number' => 'Restaurant Contact Number',
            'restaurant_image' => 'Restaurant Image',
            'city' => 'City',
            'state' => 'State',
            'restaurant_description' => 'Restaurant Description',
            'restaurant_status' => 'Restaurant Status',
            'open_time' =>'Open At',
            'close_time'=>'Close At',
            'search_param_1'=>'Restaurant Or Dishes'
        ];
    }
    public static function getRestaurantType($type){

        if ($type == 0){
            return '<i class=" fa fa-solid fa-circle" style="color: green"></i> <span class="type-item">Pure Veg</span>';
        }
        elseif ($type == 1){
            return '<i class="fa fa-solid fa-circle" style="color: red"></i> <span class="type-item">Non Veg</span>';
        }
        else{
            return '<i class="fa fa-solid fa-circle" style="color: red"></i> <span class="type-item">Veg and Non Veg</span>';
        }
    }
    public static function getTimming(){
        $data = [
            '12 AM'=> '12 AM',
            '1 AM' =>  '1 AM',
            '2 AM' =>  '2 AM',
            '3 AM' =>  '3 AM',
            '4 AM' =>  '4 AM',
            '5 AM' =>  '5 AM',
            '6 AM' =>  '6 AM',
            '7 AM' =>  '7 AM',
            '8 AM' =>  '8 AM',
            '9 AM' =>  '9 AM',
            '10 AM' =>  '10 AM',
            '11 AM' =>  '11 AM',
            '12 PM' =>  '12 PM',
            '1 PM' =>  '1 PM',
            '2 PM' =>  '2 PM',
            '3 PM' =>  '3 PM',
            '4 PM' =>  '4 PM',
            '5 PM' =>  '5 PM',
            '6 PM' =>  '6 PM',
            '7 PM' =>  '7 PM',
            '8 PM' =>  '8 PM',
            '9 PM' =>  '9 PM',
            '10 PM' =>  '10 PM',
            '11 PM' =>  '11 PM',
        ];
        return $data;
    }
    public static function getBannerData(){
        $food_items = FoodItem::find()->all();
        $restaurants = Restaurant::find()->all();
        $data = [];
        foreach ($food_items as $item) {
            $data[] = $item->item_name;
        }
        foreach ($restaurants as $restaurant) {
            $data[] = $restaurant->restaurant_name;
        }

        return $data;
    }

    public function getAverageRating($id){
        $total_review = \common\models\Review::find()->where(['restaurant_id'=>$id])->count();
        if ($total_review == 0){
            return 0;
        }
        $reviews = Review::findAll(['restaurant_id'=>$id]);
        $rating = 0;
        foreach ($reviews as $review){
                $rating = $rating + (float)$review->rating;
        }
        return $rating / $total_review;
    }
    public function getTotalIncome($id){
        $income = 0;
        $orders = Order::findAll(['restaurant_id'=>$id]);
        foreach ($orders as $order){
            $order_details = OrderDetails::findAll(['order_id'=>$order->id]);
            foreach ($order_details as $order_detail) {
                    $item = FoodItem::findOne(['id'=>$order_detail->item_id]);
                    $income = $income + $order_detail->quantity*(int)$item->item_price;
            }

        }
        return $income;
    }

}
