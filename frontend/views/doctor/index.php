<?php
/**
 * Created by PhpStorm.
 * User: haiye_000
 * Date: 11-Nov-16
 * Time: 5:59 PM
 */

use \frontend\controllers;
use yii\bootstrap\ActiveForm;

$baseUrl = Yii::$app->getUrlManager()->baseUrl;
$results=$doctor;
//var_dump($results);

?>

<div class="">
    <form action="<?php echo Yii::$app->getUrlManager()->baseUrl.'/doctor/index';?>" method="post" enctype="multipart/form-data">
        <table class="create">
            <tr>
                <td>Từ khóa</td>
                <td><input type="text" name="key"></td>
            </tr>
            <tr>
                <td>Limit</td>
                <td><input type="text" name="limit"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="search" value="Search">
            </tr>

        </table>
    </form>
</div>
<br>
<?php if(isset($_POST['search'])&& $_POST['key']!=null){ ?>
<div class="container">
    <div class="panel panel-default view">
        <div class="panel-heading">View Doctor</div>
        <div class="panel-body">
            <p>Kết quả cho <b><?php echo $_POST['key'] ?></b> và limit là <b><?php echo $limit; ?></b></p>
            <table border="1px" width="100%">
                <?php
                if (isset($results)&& sizeof($results['data']) != 0) {
                    $practices = $results['data'][0]['practices'];?>
                    <tr>
                        <td align="center" > <b>Name</b></td>
                        <td align="center"> <b> Contact</b></td>
                        <td align="center"> <b>Email</b></td>
                        <td align="center"> <b>Address</b></td>
                    </tr>
                    <?php for($k=0;$k<sizeof($results['data']);$k++){
                        $practices = $results['data'][$k]['practices'][0];
//                        var_dump($practices); die();
                        ?>
                        <tr>
                            <td > <?php echo $practices['name']; ?></a></td>
                            <td > <?php echo $practices['phones'][0]['number']; ?></td>
                            <td > <?php if($practices['email']==null) echo "NULL"; else echo $practices['email'] ?></td>
                            <td > <?php echo $practices['visit_address']['street'].",".$practices['visit_address']['city'].",".$practices['visit_address']['state_long']; ?></td>
                        </tr>

                    <?php } ?>
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
</div>
<?php } ?>


