<?php

namespace App\Controllers;

use \Core\View;
use App\Models\User;
use App\Models\AuthLogic;
use PDO;

class Login extends \Core\Controller{
public function indexAction() {
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION["user_id"])) {
        View::render('login.php', [
            'params' => $this->route_params
            ]);
    } else {
        
    }
}

public function loginAction(){
    View::render('Login.php');
}

public function createAction() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user = User::authenticate($_POST["email"], $_POST["password"]);
        $remember = isset($_POST["remember_me"]);

        if ($user) {
            AuthLogic::on_login($user, $remember);

            Flash::addMessage('Login successful');

            $this->redirect('/Home');
        } else {
            View::render('login.php', [
                'params' => $this->route_params,
                'email' => $_POST['email'],
                'remember_me' => $remember
            ]);
        }
    } else {
        View::render('login.php', [
            'params' => $this->route_params
            ]);
    }
}

public function registerAction(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $pass_err = "";
        $confpass_err = "";
        $email_err = "";

        if ($_POST['email'] == "") {
            $email_err = "please fill in your email address";
        } else if(User::find_by_email($_POST['email'])){
            $email_err = "Email is already in use";
        }

        if ($_POST['password'] == "") {
            $pass_err = "please fill in your password";
        }

        if ($_POST['confpassword'] == "") {
            $confpass_err = "please confirm your password";
        }

        if ($_POST['password'] != $_POST['confpassword']) {
            $confpass_err = "password and confirm password are not the same";
        }

        if ($_POST['user_name'] != "" && $email_err == "" && $pass_err == "" && $confpass_err == "") {
            
            $user = new User([
                'User_name' => $_POST['user_name'],
                'Email' => $_POST['email'],
                'Password' => $_POST['password'],
                'Type' => "regular"
            ]);

            if ($user->register_user()) {
                $this->redirect("/login");
            } else {
                View::render('CMS/register.php', [
                    'params' => $this->route_params,
                    'User_name' => $_POST['user_name'],
                    'email' => $_POST['email'],
                    'email_err' => $email_err,
                    'pass_err' => $pass_err,
                    'confpass_err' => $confpass_err,
                    'user_err' => $user->errors
                ]);
            }
        } else {
            View::render('register.php', [
                'params' => $this->route_params,
                'User_name' => $_POST['user_name'],
                'email' => $_POST['email'],
                'email_err' => $email_err,
                'pass_err' => $pass_err,
                'confpass_err' => $confpass_err
            ]);
        }

    } else{
        View::render('register.php', [
            'params' => $this->route_params
            ]);
    }
}
}