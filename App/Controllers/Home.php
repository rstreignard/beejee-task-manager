<?php 

namespace App\Controllers;

use Core\Controller;
use Core\View;

class Home extends Controller {

    public function indexAction() {

        View::render('Home/index.php', [
            'name' => 'Dave'
        ]);
    }
}