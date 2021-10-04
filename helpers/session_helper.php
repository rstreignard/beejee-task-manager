<?php 

session_start();

function isLoggedIn() {

    return isset($_SESSION['logged_in']);
}

function createFlashMessage($name, $message, $type) {

    if (isset($_SESSION['FLASH_MESSAGES'][$name])) {
        unset($_SESSION['FLASH_MESSAGES'][$name]);
    }

    $_SESSION['FLASH_MESSAGES'][$name] = ['message' => $message, 'type' => $type];
}

function formatFlashMessage($flash_message) {

    return sprintf('<div class="alert alert-%s">%s</div>',
        $flash_message['type'],
        $flash_message['message']
    );
}

function displayFlashMessage(string $name) {

    if (!isset($_SESSION['FLASH_MESSAGES'][$name])) {
        return;
    }

    $flash_message = $_SESSION['FLASH_MESSAGES'][$name];

    unset($_SESSION['FLASH_MESSAGES'][$name]);

    echo formatFlashMessage($flash_message);
}

function displayAllFlashMessages() {

    if (!isset($_SESSION['FLASH_MESSAGES'])) {
        return;
    }

    $flash_messages = $_SESSION['FLASH_MESSAGES'];

    unset($_SESSION['FLASH_MESSAGES']);

    foreach ($flash_messages as $flash_message) {
        
        echo formatFlashMessage($flash_message);
    }
}

function flash($name = '', $message = '', $type = '') {

    if ($name !== '' && $message !== '' && $type !== '') {

        createFlashMessage($name, $message, $type);

    } elseif ($name !== '' && $message === '' && $type === '') {
        
        displayFlashMessage($name);

    } elseif ($name === '' && $message === '' && $type === '') {

        displayAllFlashMessages();
    }
}