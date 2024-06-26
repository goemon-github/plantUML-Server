<?php
require_once 'vendor/autoload.php';

use function Jawira\PlantUml\encodep;

include 'common.php';
include 'header.php';
?>



<?php echo getHeader($page, $ploblem); ?>
<body>


    <h1 class="title">Plant UML Server</h1>

    <div class="display__container">
        <div id="editor-container" class="editor base__area"></div>
        <div id="preview-container" class="editor base__area"></div>
        <div id="answer-container" class="editor base__area">
            <div class='btn-container'>
                <button class='btn'>Answer HTML</button>
                <button class='btn'>Answer Code</button>
            </div>
        </div>
    </div>
    
    <script  src="/public/js/script.js"></script>
</body>
</html>
