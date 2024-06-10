<?php

require_once __DIR__ . '/../vendor/autoload.php';

include __DIR__ . '/../common.php';
include __DIR__ . '/../header.php';


?>



<?php echo getHeader($page, $ploblem); ?>
<body>


    <h1 class="title">Plant UML Server</h1>

    <div class='previewWrapper'>
        <button id='back' class='previewBtn'>戻る</button>
        <button id='btnSvg' class='previewBtn'>SVG</button>
        <button id='btnPng' class='previewBtn'>PNG</button>
        <button id='btnAscii' class='previewBtn'>ASCII</button>
        <button id='btnDownload' class='downloadBtn'>Download</button>
    </div>
    <div class="display__container">
        <div id="editor-container" class="editor base__area"></div>
        <div id="preview-container" class="editor base__area"></div>
        <div id="answer-container" class="editor base__area ">
            <div class='btn-container'>
                <button id='btnHtml' class='answerBtn'>Answer HTML</button>
                <button id='btnSvg' class='answerBtn'>Answer Code</button>
            </div>
        </div>
    </div>
    
    <script  src="/public/js/script.js"></script>
    <script  src="/public/js/ploblem.js"></script>
</body>
</html>
