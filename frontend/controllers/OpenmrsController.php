<?php
/**
 * Created by PhpStorm.
 * User: haiye_000
 * Date: 11-Nov-16
 * Time: 6:11 PM
 */

namespace frontend\controllers;
use Yii;
use backend\models\User;

use mdm\admin\components\AccessControl;
use yii\base\Controller;
use yii\filters\VerbFilter;
use backend\models\ServiceAccess;
use yii\helpers\Url;

class OpenmrsController extends Controller
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

    public $username;
    public $password;

    public function getUser()
    {
        $user = ServiceAccess::find()->where(['=','user_id',Yii::$app->user->identity->getId()])->asArray()->all();
        if (!$user) {
            echo "<script>alert('None');</script>";
            return Yii::$app->response->redirect(Url::to(['openmrs/null']));
        }
        else {
            $this->username = $user[0]['id3'];
            $this->password = $user[0]['pw3'];
        }
    }

    public function actionIndex()
    {
        $this->getUser();
        $curl = new curlMRS();
        $p=0;
        if(isset($_GET['page'])) $p= $_GET['page'];
        $url='http://demo.openmrs.org/openmrs/ws/rest/v1/person?q&startIndex='.$p;
        $person=$curl->get($url);
        $array=json_decode($person, true);
//        var_dump($array);

        return $this->render('index', [
            'person' =>$array,
            'nextpage' => ($p+50),
            'previouspage' => ($p-50)
        ]);
    }

    public function actionSearch()
    {
        $array=null;
        if(isset($_POST['search'])&&$_POST['key']!=null){
            $curl = new curlMRS();
            $key= $_POST['key'];
            $url='http://demo.openmrs.org/openmrs/ws/rest/v1/person?q='.$key;
            $person=$curl->get($url);
            $array=json_decode($person, true);
//            var_dump($array);die();
        }
        return $this->render('search', [
            'person' =>$array,
            'key'=>$key,
        ]);
    }

    public function actionCreate()
    {
        return $this->render('create');
    }


    public function actionDelete(){
        $curl = new curlMRS();
        $url = $_GET['url'];
        $result=$curl->delete($url);
        var_dump($result);
        Yii::$app->response->redirect(['openmrs/index']);
    }
    public function actionInfo()
    {
        $curl = new curlMRS();
        $uuid=$_GET['uuid'];
        $url='http://demo.openmrs.org/openmrs/ws/rest/v1/person/'.$uuid;
        $person=$curl->get($url);
        $array=json_decode($person, true);
//       var_dump($array);
        return $this->render('info',
            ['info'=>$array
            ]);
    }
//kkk
    public function actionAdd()
    {
        $name        = array();
        $names       = array();
        $person_data = array();

        $name['givenName'] = $_POST["givenName"];
        $name['middleName'] = $_POST["middleName"];
        $name['familyName'] = $_POST["familyName"];

        array_push($names,$name);

        $person_data['gender'] = $_POST["gender"];
        $person_data['names'] = $names;

        $person_data = json_encode($person_data);

        $person_curL = curl_init('http://demo.openmrs.org/openmrs/ws/rest/v1/person');
        curl_setopt($person_curL, CURLOPT_HTTPAUTH,CURLAUTH_BASIC);
        curl_setopt($person_curL, CURLOPT_USERPWD,"admin:Admin123");
        curl_setopt($person_curL, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($person_curL, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($person_curL, CURLOPT_POST,1);
        curl_setopt($person_curL, CURLOPT_POSTFIELDS,$person_data);
        $output   = curl_exec($person_curL);
        $status   = curl_getinfo($person_curL,CURLINFO_HTTP_CODE);
        curl_close($person_curL);
//        var_dump($output);
//        var_dump($status);
        Yii::$app->response->redirect(['openmrs/index']);
    }

    public function actionNull() {
        return $this->render('null');
    }

}