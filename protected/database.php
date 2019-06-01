<?php
/**
 * Created by PhpStorm.
 * User: Shepa
 * Date: 5/18/2019
 * Time: 11:58 AM
 */

require_once('classes/mysqlidb.php');


class Database extends MysqliDb
{
    public function __construct()
    {
        $config = include('config.php');
        parent::__construct(
            $config['db']['host'],
            $config['db']['user'],
            $config['db']['password'],
            $config['db']['name']);
        try {
            $this->connect();
        } catch (Exception $e) {
            trigger_error($e->getMessage());

        }



    }


}