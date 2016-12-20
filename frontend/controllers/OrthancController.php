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
//        curl http://localhost:8042/patients
        $patient_info = "";
        $studies = "";
        $study = array();
        $curl = new Curl();

        $patients_id = json_decode($curl->curl("http://localhost:8042/patients","GET"));
        if (isset($patients_id) && $patients_id != null) {
            for($i = 0; $i < sizeof($patients_id); $i++){
                $patient_info[$i] = json_decode($curl->curl("http://localhost:8042/patients/$patients_id[$i]","GET"));
//                var_dump($patient_info[$i]);
            }
//            die();

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
//        curl -X DELETE http://localhost:8042/patients/dc65762c-f476e8b9-898834f4-2f8a5014-2599bc94
        $url = $_GET['url'];
        $curl = new Curl();
        $curl->curl($url,"DELETE");

        Yii::$app->response->redirect(['orthanc/index']);
    }

    public function actionUpload() {
//        curl -X POST -H "Expect:" http://localhost:8042/instances --data-binary @ffc.dcm
        if (isset($_POST['upload']))
        {
            $url = "http://localhost:8042/instances"; // e.g. http://localhost/myuploader/upload.php // request URL
            $filename = $_FILES['file']['name'];
            if(move_uploaded_file($_FILES['file']['tmp_name'], "E:/tmp". DIRECTORY_SEPARATOR . $filename)) {
                $filedata = "E:/tmp". DIRECTORY_SEPARATOR . $filename;
                $output = shell_exec('curl -X POST http://localhost:8042/instances --data-binary @'.$filedata);
            }
        }
//        echo "?";
        Yii::$app->response->redirect(['orthanc/index']);
    }

    public function actionUp() {
        shell_exec('curl -X POST -H "Expect:" http://localhost:8042/instances --data-binary @ffc.dcm');
    }
}