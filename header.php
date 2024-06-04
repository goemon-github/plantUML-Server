<?php


function getHeaderTtitle($page, $ploblem=null){
    switch ($page) {
        case 'ploblemsList':
            return '問題集';
            break;
        case 'ploblem':
            return htmlspecalchars($ploblem['title']);
            break;
        default:
            return 'plant-UML-Server';
        
    }
}

function getHeader($page, $ploblem=null){

    $title = '';
    if($ploblem == null){
        $title = getHeaderTtitle($page);
    }else{
        $title = getHeaderTtitle($page, $ploblem);
    }
    
    $cssPath = '/public/css/style.css';
    //$cssPath = "public/css/style.css";

    return  "<!DOCTYPE html>
    <html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <link rel=\"stylesheet\" type=\"text/css\" href=$cssPath >
        <script src=\"https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs/loader.min.js\"></script>

            <title> $title </title>
    </head>";
}