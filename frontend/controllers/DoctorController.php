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

class DoctorController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actionIndex()
    {
        $curl = new CurlBD();
        $url="https://api.betterdoctor.com/2016-03-01/doctors?name=h&limit=100&user_key=a72b7f3033bf4008f22f05fbdb71b570";
        $doctor=$curl->get($url);
        $array=json_decode($doctor, true);
//        var_dump($array['data'][0]['uid']);
//        var_dump($array); die();
        return $this->render('index', [
            'doctor' =>$array['data'],
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
            'key'=>$key
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
        var_dump($output);
        var_dump($status);
        Yii::$app->response->redirect(['openmrs/index']);
    }

}