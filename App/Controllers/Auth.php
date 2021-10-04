<?php 

namespace App\Controllers;

use Core\Controller;
use Core\View;

class Auth extends Controller {

    public function login() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $errors = [];
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $input_data = [
                'username'  => !empty($_POST['username']) ? trim($_POST['username']) : '',
                'password'  => trim($_POST['password'])
            ];

            if (empty($input_data['username'])) {
                $errors['username'] = 'Логин обязателен для заполнения';
            }

            if (empty($input_data['password'])) {
                $errors['password'] = 'Пароль обязателен для заполнения';
            }

            if (empty($errors)) {

                if ($this->attemptLogin($input_data['username'], $input_data['password'])) {

                    $this->createUserSession();

                    flash('auth_success', 'Вы успешно авторизовались', 'success');
    
                    header('location: /tasks/index');
    
                } else {
    
                    $errors['username'] = 'Логин или пароль введены неверно';

                    $input_data['errors'] = $errors;

                    View::render('Auth/login.php', $input_data);
                }
               
            } else {

                $input_data['errors'] = $errors;

                View::render('Auth/login.php', $input_data);
            }

        } else {
            
            View::render('Auth/login.php');
        }
    }

    private function attemptLogin($username, $password) {

        return $username === 'admin' && $password === '123';
    }

    private function createUserSession() {

        $_SESSION['logged_in'] = 1;
    }
  
    public function logout() {

        unset($_SESSION['logged_in']);

        session_destroy();

        header('location: /tasks/index');
    }
}