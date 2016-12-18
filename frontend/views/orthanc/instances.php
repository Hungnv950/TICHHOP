<?php
/**
 * Created by PhpStorm.
 * User: haiye_000
 * Date: 14-Nov-16
 * Time: 3:11 PM
 */
echo "<h1> Instances </h1>";
foreach ($instances as $key=>$value) {
    if (isset($key)){
        echo $key.": ";
        if (is_array($value)) {
            foreach ($value as $data => $item) {
                ?>
                <p><a href="<?php echo Yii::$app->getUrlManager()->baseUrl."/orthanc/instances?id=".$item ?>"><?= $item?></a></p>
                <?php
            }
        }
        if (is_string($value) || is_numeric($value)){
            if ($key =="ID") {
                $url = "http://localhost:8042/instances/".$value."/preview";
                echo "<a href=$url>".$value."</a><br>";
            }else
            {
                echo $value."<br>";
            }

        }
        if (is_object($value)){
            foreach ($value as $data=>$item) {
                echo  $data.": ".$item."<br>";
            }
        }
    }
}
?>
<img src="" alt="">
