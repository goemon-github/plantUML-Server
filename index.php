<?php
require_once 'vendor/autoload.php';

use function Jawira\PlantUml\encodep;

include 'header.php';
include 'functions.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css" >
    <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs/loader.min.js"></script>

    <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        $ploblem = null;

        if($page == 'ploblem' && isset($_GET["id"])){
            $ploblem = getPloblemId($_GET['id']);
            var_dump($ploblem);
        }



    ?>
        <title><?php echo $ploblem ? $ploblem['titile'] : 'home' ?></title>
</head>
<body>


    <h1 class="title">Plant UML Server</h1>

    <div class="display__container">
        <div id="editor-container" class="editor__box base__area"></div>
        <div id="preview-container" class="editor__box base__area"></div>
        <div id="answer-container" class="editor__box base__area">
            <div class='btn-container'>
                <button class='btn'>Answer HTML</button>
                <button class='btn'>Answer Code</button>
            </div>
        </div>
    </div>
    
    <script  src="public/js/script.js"></script>
</body>
</html>
