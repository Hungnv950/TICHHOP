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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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

    public function actionIndex()
    {
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

    public function actionCreate()
    {
        return $this->render('create');
    }
    public function actionAdd()
    {
        if(isset($_POST["create"])) {
            $name = array();
            $names = array();
            $person_data = array();

            $name['givenName'] = $_POST["givenName"];
            $name['middleName'] = $_POST["middleName"];
            $name['familyName'] = $_POST["familyName"];

            array_push($names, $name);

            $person_data['gender'] = $_POST["gender"];
            $person_data['birthday'] = $_POST["birthday"];
            $person_data['names'] = $names;

            $person_data = json_encode($person_data);
            $url = "http://demo.openmrs.org/openmrs/ws/rest/v1/person";
            $curl = new curlMRS();
            $out=$curl->create($person_data, $url);
            var_dump($out);
        }
        Yii::$app->response->redirect(['openmrs/index']);

    }
    public function actionDelete(){
        $curl = new Curl();
        $url = $_GET['url'];
        $result=$curl->curl($url,"DELETE");
        var_dump($result); die();
        Yii::$app->response->redirect(['openmrs/index']);
    }

}