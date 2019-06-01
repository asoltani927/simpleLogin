# simpleLogin
Simple Php Login

This code uses ajax and json.

  How filter input data in php: Request.php


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
   
   
Three-step registration
   1. Get email address
   2. Validation email activation code
   3. Get Fullname and password and finsished sign up
   
   All operations are ajax and json. The source is OOP and you can easily learn php.
