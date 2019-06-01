<?php
/**
 * Created by PhpStorm.
 * User: Shepa
 * Date: 5/18/2019
 * Time: 11:55 AM
 */

session_start();




require_once("request.php");
require_once("response.php");
require_once("database.php");
require_once("auth.php");

class App
{
    public $req;
    public $res;
    public $db;
    public $auth;

    public function __construct()
    {
        $this->req = new Request();
        $this->db = new Database();
        $this->auth = new Auth($this->db);
        $this->res = new Response();

    }


    public function getUrl()
    {
        return 'http://localhost/login/';

    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.

        $this->db->disconnect();
    }
}

$app = new App();