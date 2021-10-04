<?php 

namespace App\Models;

use Core\Model;
use PDO;

class Task extends Model {

    public static function getAll($orderBy, $order, $tasksPerPage, $page) {

        $db = static::getDB();

        $offset = $tasksPerPage * ($page - 1);

        $stmt = $db->query("SELECT * FROM tasks ORDER BY $orderBy $order LIMIT $tasksPerPage OFFSET $offset");
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public static function count() {

        $db = static::getDB();

        $stmt = $db->query("SELECT count(*) FROM tasks");

        $number_of_rows = $stmt->fetchColumn(); 

        return $number_of_rows;
    }

    public static function getTaskById($id) {

        $db = static::getDB();

        $stmt = $db->prepare('SELECT * FROM tasks WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    public static function addTask($data) {

        $db = static::getDB();

        $stmt = $db->prepare('INSERT INTO tasks (name, email, body) VALUES (:name, :email, :body)');

        return $stmt->execute($data) ? true : false;
    }

    public static function updateTask($data) {

        $db = static::getDB();

        $stmt = $db->prepare('UPDATE tasks SET name = :name, email = :email, body = :body, is_complete = :is_complete, is_modified = :is_modified WHERE id = :id');
        
        return $stmt->execute($data) ? true : false;
    }

    public static function deleteTask($id) {

        $db = static::getDB();

        $stmt = $db->prepare('DELETE FROM tasks WHERE id = :id');

        return $stmt->execute(['id' => $id]) ? true : false;
    }
}