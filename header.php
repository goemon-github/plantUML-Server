<?php

function getHeaderTtitle($page, $ploblem=null){
    switch ($page) {
        case 'ploblemsList':
            return '問題集';
            break;
        case 'ploblem':
            return htmlspecalchars($ploblem['title']);
            break;
    }
}