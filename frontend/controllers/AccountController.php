<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\UploadedFile;
/**
 * Site controller
 */
class AccountController extends Controller
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
                        'actions' => ['edit-profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionEditProfile()
    {
        $model = \common\models\User::findOne(Yii::$app->user->identity->id);


        if (Yii::$app->user->can('customer')) {


        $customer = \common\models\Customer::findOne(['user_id'=>Yii::$app->user->identity->id]);
         if ($customer->load(Yii::$app->request->post()) && $customer->validate()) {
            $customer->save();
            Yii::$app->session->setFlash('success', 'Account Updated Succesfully');
         }
         return $this->render('edit-customer',['model'=>$model,'customer'=>$customer]);
        }
        if (Yii::$app->user->can('restaurant')) {


        $restaurant = \common\models\Restaurant::findOne(['user_id'=>Yii::$app->user->identity->id]);
        $old_restaurant_image = $restaurant->restaurant_image;
         if ($restaurant->load(Yii::$app->request->post()) && $restaurant->validate()) {
             $restaurant_image = UploadedFile::getInstance($restaurant, 'restaurant_image');
            if($restaurant_image){
                    $file_type = $restaurant_image->extension;
                    $unique_name = uniqid('profile_image_');
                    $file_name =  $unique_name.'.'.$file_type;
                    $file_path = 'uploads/profile_images';
                    $restaurant_image->saveAs($file_path .'/'. $file_name);
                    $restaurant->restaurant_image  = $file_name;
                
                  }
                  else{
                        $restaurant->restaurant_image = $old_restaurant_image;
                  }
            $restaurant->save();
            Yii::$app->session->setFlash('success', 'Account Updated Succesfully');
         }
         return $this->render('edit-restaurant',['model'=>$model,'restaurant'=>$restaurant]);
        }
        
    }

 
}
