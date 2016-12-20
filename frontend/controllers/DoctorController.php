<?php
/**
 * Created by PhpStorm.
 * User: haiye_000
 * Date: 11-Nov-16
 * Time: 6:11 PM
 */

namespace frontend\controllers;
use Yii;

use mdm\admin\components\AccessControl;
use yii\base\Controller;
use yii\filters\VerbFilter;
use backend\models\ServiceAccess;
use yii\helpers\Url;

class DoctorController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [

            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index','create','update','view'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }

    public $key;

    public function getKey()
    {
        if (!Yii::$app->user->isGuest) {
            $user = ServiceAccess::find()->where(['=','user_id',Yii::$app->user->identity->getId()])->asArray()->all();
            if (!$user) {
                echo "<script>alert('You don\'t have permission'');</script>";
                $url = Url::to(['openmrs/null']);
                header("Location: localhost: ".$url); /* Redirect browser */
                exit();
            }
            else {
                $this->key = $user[0]['pw1'];
            }
        }
        else {
            return Yii::$app->response->redirect(Url::to(['openmrs/null']));
        }
    }

    /**
     * @inheritdoc
     */
    public function actionIndex()
    {
        $this->getKey();
        $key = $this->key;
        if ($this->key =='' ){
            return Yii::$app->response->redirect(Url::to(['openmrs/null']));
        }

        $array=null;
        $limit=5;
        if(isset($_POST['search']) && $_POST['key']!=null){
            $curl = new CurlBD();
            if($_POST['limit']!=null && is_int(intval($_POST['limit']))) $limit=$_POST['limit'];
            $url="https://api.betterdoctor.com/2016-03-01/doctors?name=".$_POST['key']."&limit=".$limit."&user_key=".$key;
            $doctor=$curl->get($url);
            $array=json_decode($doctor, true);
//        var_dump($array['data'][0]['uid']);
//        var_dump($array); die();
        }
        return $this->render('index', [
            'doctor' =>$array,
            'limit'=>$limit
        ]);
    }
}