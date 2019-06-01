<?php
/**
 * Created by PhpStorm.
 * User: Shepa
 * Date: 5/18/2019
 * Time: 11:47 AM
 */

require_once('protected/app.php');

if(!$app->auth->valid())
{
    $app->res->redirect("signin.php");
}

include_once('views/index.php');


