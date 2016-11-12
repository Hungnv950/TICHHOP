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

class AppController extends Controller
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

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionOrthanc() {
        $patient_info = "";
        $studies = "";
        $study = array();
        $curl = new Curl();

        $patients_id = json_decode($curl->curl("http://localhost:8042/patients","GET"));
        if (isset($patients_id) && $patients_id != null) {
            $patient_info = json_decode($curl->curl("http://localhost:8042/patients/$patients_id[0]","GET"));

            $studies_id = json_decode($curl->curl("http://localhost:8042/studies/", "GET"));
            for ($i=0; $i< sizeof($studies_id);$i++){
                $study[$i] = json_decode($curl->curl("http://localhost:8042/studies/$studies_id[$i]", "GET"));
            }
        }

        return $this->render('orthanc', [
            'patients_id' => $patients_id,
            'patient_info' => $patient_info,
            'study' => $study
        ]);
    }

    public function actionDelete(){
        $url = $_GET['url'];
        $curl = new Curl();
        $curl->curl($url,"DELETE");
        return $this->render('orthanc');
    }

}