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

<div class="">
    <a href="<?= Yii::$app->getUrlManager()->baseUrl?>/openmrs/create" class="btn btn-info">Create Person</a>
</div>
<div class="">
    <form action="<?php echo Yii::$app->getUrlManager()->baseUrl.'/openmrs/add/';?>" method="post" enctype="multipart/form-data">
        <table class="create">
            <tr>
                <td><input type="text" name="key"></td>
                <td><input type="submit" name="search"></td>
            </tr>

        </table>
    </form>
</div>
<div class="container">
    <div class="panel panel-default view">
        <div class="panel-heading">View Person</div>
        <div class="panel-body">
            <table>
                <?php
                if (isset($results)&& $results != null) {
                    for($k=0;$k<sizeof($results);$k++){?>
                        <tr>
                            <td width="400px" > <a href="<?php echo $baseUrl."/openmrs/info?uuid=".$results[$k]['uuid'] ?>"><?php echo $results[$k]['display']; ?></a></td>
                            <td><a href="<?php echo $baseUrl."/openmrs/delete?url=".$patients_url.$results[$k]['uuid'] ?>" class="btn btn-danger"
                                   id = "delete_patient">Delete</a></td>
                            <td width="400px"> <a href="<?php echo $baseUrl."/openmrs/info?uuid=".$results[$k]['uuid'] ?>"><?php $k++; echo $results[$k]['display']?></a></td>
                            <td><a href="<?php echo $baseUrl."/openmrs/delete?url=".$patients_url.$results[$k]['uuid'] ?>" class="btn btn-danger"
                                   id = "delete_patient">Delete</a></td>

                        </tr>



                    <?php } ?>
                    <tr>
                        <td colspan="2" align="center"><?php if($previouspage >=0){?><a href="<?= Yii::$app->getUrlManager()->baseUrl?>/openmrs/index?<?php echo "page=".$previouspage;?>">Trang trước</a><?php }?></td>

                        <td colspan="2" align="center"><a href="<?= Yii::$app->getUrlManager()->baseUrl?>/openmrs/index?<?php echo "page=".$nextpage;?>">Trang sau</a></td>

                    </tr>
                <?php }
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


