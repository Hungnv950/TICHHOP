<?php

namespace app\api\modules\v1\controllers;

use fproject\rest\ActiveController;
use yii\web\Response;

class AuthenticationController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        
        return $behaviors;
    }
}