<?php


/**
 * Created by PhpStorm.
 * User: Shepa
 * Date: 5/18/2019
 * Time: 12:04 PM
 */
class Auth
{
    private $user = false;
    private $db = false;

    public function __set($name, $value)
    {
        // TODO: Implement __set() method.

        if ($this->user !== false)
            $this->user[$name] = $value;
    }

    public function __get($name)
    {
        // TODO: Implement __get() method.

        if (isset($this->user[$name]))
            return $this->user[$name];
        return '';
    }

    public function __construct(Database $db)
    {
        $this->db = $db;
        if (isset($_SESSION["user_auth"]) and !empty($_SESSION["user_auth"])) {
// here init user variable

            $this->user = $_SESSION["user_auth"];
        } else {
            $this->user = false;
        }
    }

    public function valid()
    {
        if (is_array($this->user) and isset($this->user['user_email']))
            return true;
        return false;
    }

    public function set($user)
    {
        $_SESSION["user_auth"] = $user;
    }

    public function hashPassword($password)
    {
        return hash('sha512', ($password . 'daU>/&^%@sG'));
    }

    public function comparePassword($password, $hashedPass)
    {
        return (hash('sha512', ($password . 'daU>/&^%@sG')) == $hashedPass);
    }
}