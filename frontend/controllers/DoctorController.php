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
        $array=null;
        $limit=5;
        if(isset($_POST['search']) && $_POST['key']!=null){
            $curl = new CurlBD();
            if($_POST['limit']!=null && is_int(intval($_POST['limit']))) $limit=$_POST['limit'];
            $url="https://api.betterdoctor.com/2016-03-01/doctors?name=".$_POST['key']."&limit=".$limit."&user_key=a72b7f3033bf4008f22f05fbdb71b570";
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