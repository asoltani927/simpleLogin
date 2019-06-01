<?php
/**
 * Created by PhpStorm.
 * User: Shepa
 * Date: 5/18/2019
 * Time: 11:47 AM
 */

require_once('protected/app.php');

if ($app->auth->valid()) {
    $app->res->redirect("index.php");
}

if (!empty($app->req->post('submit'))) {
    $email = $app->req->post('email');
    $name = $app->req->post('name');
    $password = $app->req->post('password');
    $code = $app->req->post('code');
    require_once('protected/models/userstemp.php');
    require_once('protected/models/users.php');
    $tempModel = new UsersTemp($app->db);
    $usersModel = new Users($app->db);
    /*
     * check if exists in users table
     */
    $count = $usersModel->get_with_email_count($email);
    if ($count > 0) {
        $app->res->json([
            'ok' => false,
            'message' => 'You have already registered.',
            'class' => 'alert alert-warning'
        ]);
    }
    switch ($app->req->post('submit')) {
        case 'email':
            /*
             * check if exists in users temp table
             */

            $count = $tempModel->get_with_email_count($email);

            if ($count > 0) {
                $app->res->json([
                    'ok' => true,
                    'message' => 'please enter code ...',
                    'class' => 'alert alert-warning'
                ]);
            }

            if (strlen($email) > 255) {
                $app->res->json([
                    'ok' => false,
                    'message' => 'email address is login (most be < 255)...'
                ]);
            }
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {


                $key = rand(100000, 999999);
                $data = Array(
                    "user_email" => $email,
                    "user_key" => $key,
                    "user_date" => time()
                );
                $id = $app->db->insert("users_temp", $data);
                if ($id > 0) {

                    mail($email, "sign up code", $key);
                    $app->res->json([
                        'ok' => true,
                        'message' => 'please check mail box and enter code here!',
                        'class' => 'alert alert-success'
                    ]);
                } else {
                    $app->res->json([
                        'ok' => true,
                        'message' => 'sign up is failed',
                        'class' => 'alert alert-danger'
                    ]);
                }
            } else {

                $app->res->json([
                    'ok' => false,
                    'message' => 'email address is not valid...',
                    'class' => 'alert alert-danger'
                ]);
            }
            break;

        case 'code':

            if (!is_numeric($code) or strlen($code) !== 6) {
                $app->res->json([
                    'ok' => false,
                    'message' => 'code number is not valid...',
                    'class' => 'alert alert-danger'
                ]);
            }

            /*
             * check if exists in users temp table
             */
            $count = $tempModel->get_with_email_code_count($email, $code);
            if ($count === 1) {
                $app->res->json([
                    'ok' => true,
                    'message' => 'please enter name and password ...',
                    'class' => 'alert alert-success'
                ]);
            }
            $app->res->json([
                'ok' => false,
                'message' => 'code number is incorrect  ...',
                'class' => 'alert alert-warning',
            ]);

            break;

        case 'finished':
            $count = $tempModel->get_with_email_code_count($email, $code);
            if ($count !== 1) {
                $app->res->json([
                    'ok' => true,
                    'message' => 'code is mistake ...',
                    'class' => 'alert alert-success'
                ]);
            }
            $data = [
                'user_name' => $name,
                'user_password' => $app->auth->hashPassword($password),
                'user_email' => $email,
                'user_date' => time(),
            ];
            $id = $app->db->insert("users", $data);
            if ($id > 0) {
                $app->db->where('user_email', $email);
                if ($app->db->delete('users_temp')) {

                    $app->res->json([
                        'ok' => true,
                        'message' => 'Sign up successfully',
                        'class' => 'alert alert-success'
                    ]);
                }

                $app->res->json([
                    'ok' => true,
                    'message' => 'Sign up failed',
                    'class' => 'alert alert-danger'
                ]);
            } else {
                $app->res->json([
                    'ok' => true,
                    'message' => 'sign up is failed',
                    'class' => 'alert alert-danger'
                ]);
            }

            break;
    }
    exit();
}

include_once('views/signup.php');