<?php
    require_once 'vendor/autoload.php';
    include 'functions.php';


    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    $ploblem = null;

    if($page == 'ploblem' && isset($_GET["id"])){
        $ploblem = getPloblemId($_GET['id']);
    }