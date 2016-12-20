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

class OrthancController extends Controller
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
        $patient_info = "";
        $studies = "";
        $study = array();
        $curl = new Curl();

        $patients_id = json_decode($curl->curl("http://localhost:8042/patients","GET"));
        if (isset($patients_id) && $patients_id != null) {
            for($i = 0; $i < sizeof($patients_id); $i++){
                $patient_info[$i] = json_decode($curl->curl("http://localhost:8042/patients/$patients_id[$i]","GET"));
            }

            $studies_id = json_decode($curl->curl("http://localhost:8042/studies/", "GET"));
            for ($i=0; $i< sizeof($studies_id);$i++){
                $study[$i] = json_decode($curl->curl("http://localhost:8042/studies/$studies_id[$i]", "GET"));
            }
        }

        return $this->render('index', [
            'patients_id' => $patients_id,
            'patient_info' => $patient_info,
            'study' => $study
        ]);
    }

    public function actionStudy() {

        $id = $_GET['id'];
        $curl = new Curl();
        $study = json_decode($curl->curl("http://localhost:8042/studies/$id", "GET"));
//        var_dump($study);
        return $this->render('study',[
            'study'=> $study
        ]);
    }

    public function actionSeries () {
        $id = $_GET['id'];
        $curl = new Curl();
        $series = json_decode($curl->curl("http://localhost:8042/series/$id", "GET"));
        return $this->render('series',[
            'series'=> $series
        ]);
    }

    public function actionInstances () {
        $id = $_GET['id'];
        $curl = new Curl();
        $instances = json_decode($curl->curl("http://localhost:8042/instances/$id", "GET"));
        return $this->render('instances',[
            'instances'=> $instances
        ]);
    }

    public function actionDelete(){
        $url = $_GET['url'];
        $curl = new Curl();
        $curl->curl($url,"DELETE");

        Yii::$app->response->redirect(['orthanc/index']);
    }

    public function actionUpload() {
//        curl -X POST -H "Expect:" http://localhost:8042/instances --data-binary @CT.X.1.2.276.0.7230010.dcm
        if (isset($_POST['upload']))
        {
            $url = "http://localhost:8042/instances/"; // e.g. http://localhost/myuploader/upload.php // request URL
            $filename = $_FILES['file']['name'];
            $filedata = $_FILES['file']['tmp_name'];
            $filesize = $_FILES['file']['size'];


            if ($filedata != '')
            {
                $headers = array("Content-Type:data/binary"); // cURL headers for file uploading
                $postfields = array("filedata" => "@$filedata", "filename" => $filename);
                $ch = curl_init();
                $options = array(
                    CURLOPT_URL => $url,
                    CURLOPT_HEADER => true,
                    CURLOPT_POST => 1,
                    CURLOPT_HTTPHEADER => $headers,
                    CURLOPT_POSTFIELDS => $postfields,
                    CURLOPT_INFILESIZE => $filesize,
                    CURLOPT_RETURNTRANSFER => true
                ); // cURL options
                curl_setopt_array($ch, $options);
                curl_exec($ch);

                if(!curl_errno($ch))
                {
                    $info = curl_getinfo($ch);
                    if ($info['http_code'] == 200)
                        echo  $errmsg = "File uploaded successfully";
//                    die;
                }
                else
                {
                    $errmsg = curl_error($ch);
                    echo "ok";
                }
                curl_close($ch);
            }
            else
            {
                $errmsg = "Please select the file";
            }
        }
       // Yii::$app->response->redirect(['orthanc/index']);
    }
}