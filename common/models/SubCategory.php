<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sub_category".
 *
 * @property int $id
 * @property int $category_id
 * @property string $sub_category_name
 * @property int $status
 */
class SubCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sub_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'sub_category_name'], 'required'],
            [['category_id', 'status'], 'integer'],
            [['sub_category_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'sub_category_name' => 'Sub Category Name',
            'status' => 'Status',
        ];
    }
}
