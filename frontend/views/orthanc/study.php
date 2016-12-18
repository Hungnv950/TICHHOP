<?php
/**
 * Created by PhpStorm.
 * User: haiye_000
 * Date: 14-Nov-16
 * Time: 1:10 AM
 */


use \frontend\controllers;
use yii\bootstrap\ActiveForm;

$act = new controllers\Curl();
$baseUrl = Yii::$app->getUrlManager()->baseUrl;
$patients_url = "http://localhost:8042/patients";
?>

<div class="container">
    <div class="panel panel-default view">
        <div class="panel-heading">View Study</div>
        <div class="panel-body">
            <?php
            if (isset($study)&& $study != null) {
//                var_dump($study);
                foreach ($study as $key=>$value) {
                    if (isset($key)){
                        echo $key.": ";
                        if (is_array($value)) {
                           foreach ($value as $data => $item) {
                              ?>
                               <p><a href="<?php echo $baseUrl."/orthanc/series?id=".$item ?>"><?= $item?></a></p>
                               <?php
                           }
                        }
                        if (is_string($value)){
                            echo $value."<br>";
                        }
                        if (is_object($value)){
                            foreach ($value as $data=>$item) {
                                echo  $data.": ".$item."<br>";
                            }
                        }

                    }
                    ?>

                    <?php
                }
            }
            else {
                ?>
                <P>Null</P>
                <?php
            }
            ?>
            <br><br>
            <hr>
        </div>
    </div>
</div>