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
$patients_url = "http://demo.openmrs.org/openmrs/ws/rest/v1/person/";
$results=$person['results'];
//$curl = new curlMRS();
//var_dump($person);
?>

<div class="container">
    <div class="panel panel-default view">
        <div class="panel-heading">Search Person</div>
        <div class="panel-body">
            <p>Kết quả tìm kiếm cho <b><?php echo $key?></b></p>
            <table>
                <?php
                if ($results != null) {
                    for($k=0;$k<sizeof($results);$k++){?>
                        <tr>
                            <td width="400px" > <a href="<?php echo $baseUrl."/openmrs/info?uuid=".$results[$k]['uuid'] ?>"><?php echo $results[$k]['display']; ?></a></td>
                            <td><a href="<?php echo $baseUrl."/openmrs/delete?url=".$patients_url.$results[$k]['uuid'] ?>" class="btn btn-danger"
                                   id = "delete_patient">Delete</a></td>
                            <?php if($k+1 < sizeof($results)){?>
                            <td width="400px"> <a href="<?php echo $baseUrl."/openmrs/info?uuid=".$results[$k]['uuid'] ?>"><?php $k++; echo $results[$k]['display']?></a></td>
                            <td><a href="<?php echo $baseUrl."/openmrs/delete?url=".$patients_url.$results[$k]['uuid'] ?>" class="btn btn-danger"
                                   id = "delete_patient">Delete</a></td>
                            <?php } ?>
                        </tr>
                <?php }}
                else {
                    ?>
                    <P>Null</P>
                    <?php
                }
                ?>
                <table>
        </div>
    </div>

    <!--    <div class="panel-body">-->
    <!--        <iframe src="http://localhost:8042/app/explorer.html#upload" width="100%" height="500px" frameborder="0"></iframe>-->
    <!--    </div>-->

</div>


