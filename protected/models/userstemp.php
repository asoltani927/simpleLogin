<?php
/**
 * Created by PhpStorm.
 * User: Shepa
 * Date: 5/18/2019
 * Time: 1:35 PM
 */

class UsersTemp
{

    private $db;

    public function get_with_email($email)
    {
        try {
            return $this->db->where('user_email', $email)->get('users_temp');
        } catch (Exception $e) {
            return false;
        }
    }

    public function get_with_email_count($email)
    {
        try {
            $data = $this->db->where('user_email', $email)->get('users_temp', null, 'count(user_email) as count');

            if (isset($data[0]['count']))
                return $data[0]['count'];
            return false;
        } catch (Exception $e) {
            return false;
        }
    }
    public function get_with_email_code_count($email,$code)
    {
        try {
            $data = $this->db->where('user_email', $email)->where('user_key', $code)->get('users_temp', null, 'count(user_email) as count');

            if (isset($data[0]['count']))
                return $data[0]['count'];
            return false;
        } catch (Exception $e) {
            return false;
        }
    }


    public function __construct(Database $db)
    {
        $this->db = $db;
    }
}