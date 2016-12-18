<?php
/**
 * Created by PhpStorm.
 * User: haiye_000
 * Date: 14-Nov-16
 * Time: 3:07 PM
 */
echo "<h1> Series </h1>";

foreach ($series as $key=>$value) {
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
            echo $value."<br>";
        }
        if (is_object($value)){
            foreach ($value as $data=>$item) {
                echo  $data.": ".$item."<br>";
            }
        }
        if ($value == null) {
            echo "null<br>";
        }

    }
}