<?php
require_once __DIR__ . '/../vendor/autoload.php';

include __DIR__ . '/../common.php';
include __DIR__ . '/../header.php';

//include __DIR__ . '/../functions.php';

?>

<?php echo getHeader($page, $ploblem); ?>

<?php
   $ploblems = getPloblems();
?>

<body>
    <div class='container'>
    <table class='table'>
        <thead>
            <tr> 
                <th>ID</th>
                <th> Title </th>
                <th> Theme </th>
            </tr>
        </thead>
        <tbody class='table__body'>
            <?php foreach ($ploblems as $ploblem) : ?>
            <tr class="ploblem-item" data-id='<?php echo htmlspecialchars($ploblem['id'])?>'>
                    <td> 
                        <?= htmlspecialchars($ploblem['id'])?> 
                    </td>
                    <td> 
                        <?= htmlspecialchars($ploblem['title'])?> 
                    </td>
                    <td> 
                        <?= htmlspecialchars($ploblem['theme'])?> 
                    </td>
                </a>
            </tr>
            <?php endforeach; ?>
        <tbody>
    </table>
    </div>

    <div class='pagenation'>

    </div>


    <script  src="/public/js/script.js"></script>
</body>
</html>