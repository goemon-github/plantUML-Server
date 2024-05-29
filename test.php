<?php
require __DIR__ . '/vendor/autoload.php';
use function Jawira\PlantUml\encodep;

$uml = "@startuml\nAlice -> Bob: Authentication Request\nBob --> Alice: Authentication Response\n\nAlice -> Bob: Another authentication Request\nAlice <-- Bob: Another authentication Response\n@enduml";
        

$encode = encodep($uml);
$svg = file_get_contents("http://www.plantuml.com/plantuml/uml/svg/{$encode}");

var_dump($svg);