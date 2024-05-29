<?php
require_once 'vendor/autoload.php';

use function Jawira\PlantUml\encodep;
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
        if(isset($_GET['Pages'])){
            $title = 'Plant UML Server';
            switch ($_GET['Pages']) {
                case 'ploblemsList.php':
                    $title . '- ploblems';
                    break;

                default:
                    break;
            }
        }

        $uml = "@startuml\nAlice -> Bob: Authentication Request\nBob --> Alice: Authentication Response\n\nAlice -> Bob: Another authentication Request\nAlice <-- Bob: Another authentication Response\n@enduml";
        $encode = encodep($uml);
        $svg = file_get_contents("http://www.plantuml.com/plantuml/svg/{$encode}");


    ?>
        <title><?php echo $title ?></title>
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
                <div> <?php echo $svg ?> </div>
            </div>
        </div>
    </div>
    
    <script  src="public/js/script.js"></script>
</body>
</html>
