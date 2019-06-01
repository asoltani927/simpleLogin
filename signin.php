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
    $password = $app->req->post('password');
    require_once('protected/models/users.php');
    require_once('protected/models/userlogins.php');
    $usersModel = new Users($app->db);
    $userLoginsModel = new userLogins($app->db);


    $model = $usersModel->get_with_email($email);
    if ($model === false or !is_array($model) or !isset($model["user_name"])) {
        $app->res->json([
            'ok' => false,
            'message' => 'email or password is incorrect',
            'class' => 'alert alert-warning'
        ]);
    }

    if ($model['user_blocktime'] != 0 and $model['user_blocktime'] > time()) {
        $app->res->json([
            'ok' => false,
            'message' => 'Account is blocked',
            'class' => 'alert alert-warning'
        ]);
    }

    if ($model['user_blocktime'] != 0 and $model['user_blocktime'] <= time()) {
        $id = $app->db->where('user_id', $model['user_id'])->update('users', ["user_blocktime" => 0]);

    }

    $status = $userLoginsModel->get_user_last_try_success_status($model['user_id']);

    if ($status === false) {
        $id = $app->db->where('user_id', $model['user_id'])->update('users', ["user_blocktime"=> strtotime('+30 minutes')]);
        $app->res->json([
            'ok' => false,
            'message' => 'Account is blocked',
            'class' => 'alert alert-warning'
        ]);
    }


    if ($app->auth->comparePassword($password, $model['user_password'])) {

        $data = [
            'login_user_' => $model['user_id'],
            'login_date' => time(),
            'login_status' => true,
        ];
        $id = $app->db->insert("user_logins", $data);

        $app->auth->set($model);
        $app->res->json([
            'ok' => true,
            'message' => 'waiting ...',
            'class' => 'alert alert-success'
        ]);
    }
    $data = [
        'login_user_' => $model['user_id'],
        'login_date' => time(),
        'login_status' => false,
    ];
    $id = $app->db->insert("user_logins", $data);

    $app->res->json([
        'ok' => false,
        'message' => 'email or password is incorrect',
        'class' => 'alert alert-warning'
    ]);
}
include_once('views/signin.php');

