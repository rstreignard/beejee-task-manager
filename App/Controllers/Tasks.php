<?php 

namespace App\Controllers;

use Core\Controller;
use Core\View;

use App\Models\Task;

class Tasks extends Controller {

    public function indexAction() {

        $tasksPerPage = 3;

        $numberOfRows = Task::count();
        $totalPages = ceil($numberOfRows / $tasksPerPage);

        $orderBy = !empty($_GET['orderBy']) && in_array($_GET['orderBy'], ['name', 'email', 'is_complete']) ? $_GET['orderBy'] : 'id'; 
        $order = !empty($_GET['order']) && in_array($_GET['order'], ['ASC', 'DESC']) ? $_GET['order'] : 'ASC'; 
        $page = !empty($_GET['page']) && (int) $_GET['page'] >= 1 && (int) $_GET['page'] <= $totalPages ? (int) $_GET['page'] : 1; 

        $tasks = Task::getAll($orderBy, $order, $tasksPerPage, $page);

        View::render('Task/index.php', [
            'tasks' => $tasks,
            'totalPages' => $totalPages,
            'orderBy' => $orderBy,
            'order' => $order,
            'page' => $page
        ]);
    }

    public function addAction() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $errors = [];
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $input_data = [
                'name'  => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'body'  => trim($_POST['body'])
            ];

            if (empty($input_data['name'])) {
                $errors['name'] = 'Имя обязательно для заполнения';
            }

            if (empty($input_data['email'])) {
                $errors['email'] = 'E-Mail обязателен для заполнения';
            }

            if (!filter_var($input_data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'E-Mail не валиден';
            }

            if (empty($input_data['body'])) {
                $errors['body'] = 'Тело задачи обязательно для заполнения';
            }

            if (empty($errors)) {

                if (Task::addTask($input_data)) {

                    flash('add_task_success', 'Задача была успешно добавлена', 'success');

                    header('location: /tasks/index');
                }
               
            } else {

                $input_data['errors'] = $errors;

                View::render('Task/add.php', $input_data);
            }

        } else {
            
            View::render('Task/add.php');
        }
    }

    public function editAction() {

        if (!isLoggedIn()) header('location: /tasks/index');

        $id = (int) $this->route_params['id'];

        $data = Task::getTaskById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $errors = [];
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $input_data = [
                'name'          => trim($_POST['name']),
                'email'         => trim($_POST['email']),
                'body'          => trim($_POST['body']),
                'is_complete'   => !empty($_POST['is_complete']) ? 1 : 0,
                'is_modified'   => $data['is_modified'],
                'id'            => $id
            ];

            if (empty($input_data['name'])) {
                $errors['name'] = 'Имя обязательно для заполнения';
            }

            if (empty($input_data['email'])) {
                $errors['email'] = 'E-Mail обязателен для заполнения';
            }

            if (!filter_var($input_data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'E-Mail не валиден';
            }

            if (empty($input_data['body'])) {
                $errors['body'] = 'Тело задачи обязательно для заполнения';
            }

            if ($data['body'] != $input_data['body']) {
                $input_data['is_modified'] = 1;
            }

            if (empty($errors)) {

                if (Task::updateTask($input_data)) {

                    flash('edit_task_success', 'Задача была успешно отредактирована', 'success');

                    header('location: /tasks/' . $id . '/edit');
                }
               
            } else {

                $data['errors'] = $errors;

                View::render('Task/edit.php', $input_data);
            }

        } else {
            
            View::render('Task/edit.php', $data);
        }
    }   
    
    public function deleteAction() {

        if (!isLoggedIn()) header('location: /tasks/index');

        $id = (int) $this->route_params['id'];

        if (Task::deleteTask($id)) {

            flash('delete_task_success', 'Задача была успешно удалена', 'success');

            header('location: /tasks/index');
        }
    }   
}