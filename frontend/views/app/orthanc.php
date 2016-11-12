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
                ?>
                <p>Patient ID: <?= $id = $patient_info->ID?></p>
                <p>Patient Name: <?= $patient_info->MainDicomTags->PatientName?></p>

                <a href="<?php echo $baseUrl."/app/delete?url=".$patients_url."/".$patients_id[0] ?>" class="btn btn-danger">Delete Patient</a>
                <br><br>
            <?php
            }
            else {
                ?>
                <P>Null</P>
            <?php
            }
            ?>
        </div>
    </div>

    <div class="panel panel-default create">
        <div class="panel-heading">Studies</div>
    </div>
    <div class="panel-body">
        <?php
        if (isset($patients_id)&& $patients_id != null) {
            foreach ($study as $study) {
                var_dump($study);
                ?>
                <p>Study ID: <?= $study->ID?></p>
                <p>InstitutionName: <?php echo $study->MainDicomTags->InstitutionName?></p>
<!--                <p>--><?php //echo $study->MainDicomTags->ReferringPhysicianName?><!--</p>-->
<!--                <p>--><?php //echo $study->MainDicomTags->StudyDate?><!--</p>-->
<!--                <p>--><?php //echo $study->MainDicomTags->StudyDescription?><!--</p>-->
<!--                <p>--><?php //echo $study->PatientMainDicomTags->PatientName?><!--</p>-->

        <?php
            }
        } else {
            ?>
            <P>Null</P>
            <?php
        }
        ?>
    </div>

    <div class="panel panel-default delete">
        <div class="panel-heading">Panel Heading</div>
        <div class="panel-body">Panel Content</div>
    </div>
</div>
