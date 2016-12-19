<?php
/**
 * Created by PhpStorm.
 * User: haiye_000
 * Date: 11-Nov-16
 * Time: 5:59 PM
 */

use \frontend\controllers;
use yii\bootstrap\ActiveForm;

?>


<div class="panel panel-default create">
    <div class="panel-heading">Create Person</div>
    <form action="<?php echo Yii::$app->getUrlManager()->baseUrl.'/openmrs/add/';?>" method="post" enctype="multipart/form-data">
        <table class="create">
            <tr>
                <td>Họ</td><td><input type="text" name="givenName"></td>
            </tr>
            <tr>
                <td>Tên đệm</td><td><input type="text" name="middleName"></td>
            </tr>
            <tr>
                <td>Tên</td><td><input type="text" name="familyName"><br></td>
            </tr>
            <tr>
                <td>Ngày sinh</td><td><input type="date" name="birthday"></td>
            </tr>
            <tr>
                <td>Giới tính</td><td><input type="radio" name="gender" value="Male"> Male <input type="radio" name="gender" value="Female"> Female</td>
            </tr>

            <tr>
                <td colspan="2" align="center"><input type="submit" name="create" value="Create"></td>
            </tr>

        </table>
    </form>
</div>