<?php

/* @var $this yii\web\View */

$this->title = 'Trang chủ';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Chào mừng tới hệ thống quản lí!</h1>

        <p class="lead">Chọn dịch vụ bạn muốn sử dụng</p>
    </div>

    <div class="body-content">

        <div class="row" style="text-align: center">
            <div class="col-lg-4">
                <h2>Something</h2>

                <p>Mô tả</p>

                <p><a class="btn btn-primary" href="http://www.yiiframework.com/doc/">Sử dụng</a></p>
            </div>
            <div class="col-lg-4">
                <h2>OrthanC</h2>

                <p>Mô tả</p>

                <p><a class="btn btn-success" href="<?= Yii::$app->getUrlManager()->baseUrl?>/orthanc/index">Sử dụng</a></p>
            </div>
            <div class="col-lg-4">
                <h2>GaiaEHR</h2>

                <p>Mô tả</p>

                <p><a class="btn btn-danger" href="http://www.yiiframework.com/extensions/">Sử dụng</a></p>
            </div>
        </div>

    </div>
</div>
