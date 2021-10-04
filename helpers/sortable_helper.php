<?php 

function sortableColumn($column, $label) {

    $url = '';

    $page = isset($_GET['page']) ? $_GET['page'] : null;
    $order = isset($_GET['order']) ? $_GET['order'] : null;
    $orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : null;

    $url .= "?orderBy=$column&";

    if ($orderBy == $column && $order == 'ASC') {

        $url .= "order=DESC";
        $arrow = '&uarr;';

    } else if ($orderBy == $column && $order == 'DESC') {

        $url .= "order=ASC";
        $arrow = '&darr;';
    
    } else {

        $url .= "order=ASC";
        $arrow = '';
    }

    if ($page) {

        $url .= "&page=$page";
    }
    
    return $html = '<a href="'.$url.'" class="sortable-column">'.$label.' '.$arrow.'</a>';
}