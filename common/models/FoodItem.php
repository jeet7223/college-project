<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "food_item".
 *
 * @property int $id
 * @property int $restaurant_id
 * @property string $item_name
 * @property string $item_description
 * @property string|null $item_image
 * @property string $item_price
 * @property int $category
 * @property int $subcategory
 * @property int $status
 * @property string $created_at
 * @property int $type
 */
class FoodItem extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['restaurant_id', 'item_name', 'item_description', 'item_price', 'category'], 'required'],
            [['restaurant_id', 'category', 'subcategory','type'], 'integer'],
            [['item_description'], 'string'],
            [['created_at','status','item_image','subcategory'], 'safe'],
            [['item_name'], 'string', 'max' => 100],
            [['item_price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'restaurant_id' => 'Restaurant ID',
            'item_name' => 'Item Name',
            'item_description' => 'Item Description',
            'item_image' => 'Item Image',
            'item_price' => 'Item Price',
            'category' => 'Category',
            'subcategory' => 'Subcategory',
            'created_at' => 'Created At',
            'status'=>'Status',
        ];
    }
    public static function getCategory($id){
        $cat = \common\models\Category::findOne($id);
        return $cat->category_name;

    }
    public static function getSubCategory($id){
        $cat = \common\models\SubCategory::findOne($id);
        return $cat->sub_category_name;

    }
}
