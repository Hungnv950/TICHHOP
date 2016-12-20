<?php
/**
 * Created by PhpStorm.
 * User: haiye_000
 * Date: 11-Nov-16
 * Time: 5:59 PM
 */

use \frontend\controllers;
use yii\bootstrap\ActiveForm;

$act = new controllers\Curl();
$baseUrl = Yii::$app->getUrlManager()->baseUrl;
$patients_url = "http://localhost:8042/patients";
?>

<div class="container">
    <div class="panel panel-default view">
        <div class="panel-heading">View Paitent</div>
        <div class="panel-body">
            <?php
            if (isset($patients_id)&& $patients_id != null) {
                foreach ($patient_info as $patient) {
                    ?>
                    <p>Patient ID: <?= $id = $patient->ID?></p>
                    <p>Patient Name: <?= $patient->MainDicomTags->PatientName?></p>

                    <?php
                    if (isset($patient->Studies)){
                        foreach ($patient->Studies as $value){
                            ?>
                    <p><a href="<?php echo $baseUrl."/orthanc/study?id=".$value ?>">Studies: <?= $value?></a></p>
                            <?php
                        }
                    }
                    ?>
                    <a href="<?php echo $baseUrl."/orthanc/delete?url=".$patients_url."/".$id ?>" class="btn btn-danger"
                       id = "delete_patient">Delete Patient</a>
                    <br><br>
                    <hr>
                    <?php
                }
            }
            else {
                ?>
                <P>Null</P>
            <?php
            }
            ?>
        </div>
    </div>
    <a href="<?php echo Yii::$app->getUrlManager()->baseUrl.'/orthanc/up/';?>" class="btn btn-success">up</a>
    <div class="panel panel-default create">
        <div class="panel-heading">Upload DCM file</div>
        <form action="<?php echo Yii::$app->getUrlManager()->baseUrl.'/orthanc/upload/';?>" method="post" enctype="multipart/form-data">
            <input type="file" name="file">
            <input type="submit" name="upload" value="Upload">
        </form>
    </div>

</div>
