<?php
require __DIR__ . '/vendor/autoload.php';
use function Jawira\PlantUml\encodep;




if($_SERVER["REQUEST_METHOD"] == "POST"){
    $input = json_decode(file_get_contents("php://input"), true);

    if(isset($input['uml'])){
        $uml = $input['uml'];
        
        $encode = encodep($uml);
        $svg = file_get_contents("http://www.plantuml.com/plantuml/svg/{$encode}");
        header('Content-Type: application/json');

        $json = json_encode(["svg" => $svg]);
        echo $json;
    }
}