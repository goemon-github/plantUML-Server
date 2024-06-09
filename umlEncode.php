<?php
require __DIR__ . '/vendor/autoload.php';
use function Jawira\PlantUml\encodep;




if($_SERVER["REQUEST_METHOD"] == "POST"){
    $input = json_decode(file_get_contents("php://input"), true);

    if(isset($input['uml'])){
        $uml = $input['uml'];
        $type = $input['type'];
        
        $encode = encodep($uml);

        switch ($type) {
            case 'ascii':
                $ascii = file_get_contents("http://www.plantuml.com/plantuml/txt/{$encode}");
                $json = json_encode(["image" => $ascii]);
                break;
            case 'png':
                $png = file_get_contents("http://www.plantuml.com/plantuml/png/{$encode}");
                //$json = json_encode(["image" => base64_encode($png)]);
                $json = json_encode(["image" => base64_encode($png)]);
                break;
            default:
                $svg = file_get_contents("http://www.plantuml.com/plantuml/svg/{$encode}");
                $json = json_encode(["image" => $svg]);
                break;
        }

        header('Content-Type: application/json');
        echo $json;
    }


}
