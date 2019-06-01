<?php
/**
 * Created by PhpStorm.
 * User: Shepa
 * Date: 5/18/2019
 * Time: 12:20 PM
 */

class Response
{

    public function redirect($to)
    {

        header('location: ' . $to);
        exit();
    }

    public function json($array)
    {
        header('content-type: application/json');
        echo json_encode($array);
        exit();
    }
}