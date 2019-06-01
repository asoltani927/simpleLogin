<?php
/**
 * Created by PhpStorm.
 * User: Shepa
 * Date: 5/18/2019
 * Time: 4:20 PM
 */

class userLogins
{

    private $db;

    public function get_user_last_try_success_status($user_id)
    {
        $data = $this->db->where('login_user_', $user_id)->orderBy("login_id", "desc")->get('user_logins', 3);

        if (count($data) == 3) {
            foreach ($data as $user) {
                if ($user['login_status'] == true) {
                    return true;
                    break;
                }
            }
            return false;
        }
        return true;
    }


    public function __construct($db)
    {
        $this->db = $db;
    }
}