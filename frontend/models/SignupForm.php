<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Customer;
use common\models\Restaurant;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $customer_first_name;
    public $customer_address;
    public $customer_last_name;
    public $customer_contact_number;
    public $restaurant_name;
    public $restaurant_address;
    public $restaurant_contact_number;
    public $restaurant_image;
    public $city;
    public $state;
    public $restaurant_description;





    const SCENARIO_CUSTOMER = 'customer';
    const SCENARIO_RESTAURANT = 'restaurant';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            [['customer_first_name','customer_last_name','restaurant_name','city','state'],'string','max'=>100],
            ['password', 'required'],
            [['customer_contact_number','restaurant_contact_number'],'number'],
            [['customer_contact_number','restaurant_contact_number'], 'string', 'min' => 10,'max'=>10],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            [['customer_first_name','customer_address','customer_last_name','customer_contact_number'], 'required', 'on' => self::SCENARIO_CUSTOMER],
            [['restaurant_name','restaurant_address','restaurant_description','restaurant_contact_number','city','state'], 'required', 'on' => self::SCENARIO_RESTAURANT],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signupCustomer()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;

        $user->status  =User::STATUS_ACTIVE;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->save();
        $customer = new Customer();
        $customer->user_id = $user->id;
        $customer->customer_first_name = $this->customer_first_name;
        $customer->customer_last_name  = $this->customer_last_name;
        $customer->customer_contact_number  = $this->customer_contact_number;
        $customer->customer_address   = $this->customer_address ;
        $customer->save(false);
        $auth = \Yii::$app->authManager;
        $authorRole = $auth->getRole('customer');
        $auth->assign($authorRole, $user->id);
        $this->sendEmail($user);
        return true;

    }
    public function signupRestaurant()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status =User::STATUS_ACTIVE;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->save();
        $restaurant = new Restaurant();
        $restaurant->user_id = $user->id;
        $restaurant->restaurant_name = $this->restaurant_name;
        $restaurant->restaurant_description  = $this->restaurant_description;
        $restaurant->restaurant_contact_number  = $this->restaurant_contact_number;
        $restaurant->restaurant_address   = $this->restaurant_address ;
        $restaurant->city   = $this->city ;
        $restaurant->state   = $this->state ;
        $restaurant->save(false);
        $auth = \Yii::$app->authManager;
        $authorRole = $auth->getRole('restaurant');
        $auth->assign($authorRole, $user->id);
        return true;

    }
    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
     /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customer_first_name' => 'First Name',
            'customer_last_name' => 'Last Name',
            'customer_contact_number' => 'Contact Number',
            'customer_address' => ' Address',
            'restaurant_name'=>'Restaurant Name',
            'restaurant_address'=>'Restaurant Address',
            'restaurant_contact_number'=>'Contact Number',
            'restaurant_image'=>'Restaurant Image',
            'restaurant_description'=>'Description',
        ];
    }

}
