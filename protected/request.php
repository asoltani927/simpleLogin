<?php
/**
 * Created by PhpStorm.
 * User: Shepa
 * Date: 5/18/2019
 * Time: 11:56 AM
 */

class Request
{
    private $post_filter = [];
    private $get_filter = [];

    public function get($name, $default = '')
    {
        if (!isset($_GET[$name]) and !isset($this->get_filter[$name]))
            return $default;
        if (!isset($this->get_filter[$name]))
            $this->get_filter[$name] = filter_input(INPUT_GET, $name, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this->get_filter[$name];
    }

    public function post($name, $default = '')
    {
        if (!isset($_POST[$name]) and !isset($this->post_filter[$name]))
            return $default;
        if (!isset($this->post_filter[$name]))
            $this->post_filter[$name] = filter_input(INPUT_POST, $name, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this->post_filter[$name];

    }


}