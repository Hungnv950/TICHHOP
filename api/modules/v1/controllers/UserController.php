<?php
/**
 * Created by PhpStorm.
 * User: haiye_000
 * Date: 22-Sep-16
 * Time: 4:06 PM
 */

namespace app\api\modules\v1\controllers;


class UserController extends AuthenticationController
{
    public $modelClass = 'backend\models\User';
}