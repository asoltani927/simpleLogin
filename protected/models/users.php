<?php
/**
 * Created by PhpStorm.
 * User: Shepa
 * Date: 5/18/2019
 * Time: 1:34 PM
 */

class Users
{


    private $db;

    public function get_with_email($email)
    {
        try {
            $data = $this->db->where('user_email', $email)->get('users');

            if (isset($data[0]))
                return $data[0];
            return false;

        } catch (Exception $e) {
            return false;
        }
    }


    public function get_with_email_count($email)
    {
        try {
            $data = $this->db->where('user_email', $email)->get('users', null, 'count(user_email) as count');
            if (isset($data[0]['count']))
                return $data[0]['count'];
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

    public function __construct($db)
    {
        $this->db = $db;
    }
}