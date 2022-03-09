<?php
namespace frontend\models;
use Yii;
use yii\base\Model;

class Charge extends Model
{

    public static function insertCharge($amount)
    {
        $stripe_secret = "sk_test_51H2GVPHzcrWIwyYMaErWNlS9sigOa3QwQrbITJjAim9R0kNHEYzQT0ynXfh0INePL5jcsyDoeMb3Zx9yICBDc58x00JQfuZ1kR";
        \Stripe\Stripe::setApiKey($stripe_secret);

        $request = Yii::$app->request;

        $token = $request->post('stripeToken');


        //$token  = $_POST['stripeToken'];

        $customer = \Stripe\Customer::create(array(
            'email' => Yii::$app->user->identity->email,
            'source'  => $token
        ));

        $charge = \Stripe\Charge::create(array(
            'customer' => $customer->id,
            'amount'   => $amount*100,
            'currency' => 'inr'
        ));

    }//end function

}//end class

?>