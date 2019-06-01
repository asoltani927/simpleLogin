<?php
/**
 * Created by PhpStorm.
 * User: Shepa
 * Date: 5/18/2019
 * Time: 4:11 PM
 */


require_once('protected/app.php');
session_destroy();

$app->res->redirect('signin.php');