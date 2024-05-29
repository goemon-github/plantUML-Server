<?php

function getPloblems(){
    $json = file_get_contents('ploblems.json');
    return json_decode($json, true);
}

function getPloblemId($id){
    $ploblemsJson = getPloblems();
    foreach ($ploblemsJson as $ploblem) {
        if($ploblem['id'] == $id){
            return $ploblem;
        }
    }
    return null;
}

