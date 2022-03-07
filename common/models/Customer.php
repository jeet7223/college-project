<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property int $user_id
 * @property string $customer_first_name
 * @property string $customer_last_name
 * @property string $customer_contact_number
 * @property string $customer_address
 *
 * @property User $user
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_first_name', 'customer_last_name', 'customer_contact_number', 'customer_address'], 'required'],
            [['user_id'], 'integer'],
            [['customer_address'], 'string'],
            [['customer_first_name', 'customer_last_name'], 'string', 'max' => 100],
              [['customer_contact_number'],'number'],
            [['customer_contact_number'], 'string', 'min' => 10,'max'=>10],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'customer_first_name' => 'Customer First Name',
            'customer_last_name' => 'Customer Last Name',
            'customer_contact_number' => 'Customer Contact Number',
            'customer_address' => 'Customer Address',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
