<?php
require_once __DIR__ . '/../vendor/autoload.php';

include __DIR__ . '/../common.php';
include __DIR__ . '/../header.php';

//include __DIR__ . '/../functions.php';

?>

<?php echo getHeader($page, $ploblem); ?>

<?php
    $ploblems = getPloblems();

    $limit = 5;
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $start = ($page - 1) * 5;

    $total = count($ploblems);

    $slicePloblems = array_slice($ploblems, $start, $limit);


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
            <?php foreach ($slicePloblems as $ploblem) : ?>
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
    <?php
        $total_pages = ceil($total / $limit);
        if ($total_pages > 1):
    ?>
        <nav>
            <ul>
                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                <li>
                    <a href='ploblems.php?page=<?php echo $i; ?>'><?php echo $i; ?></a>
                </li>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php endif; ?>
    </div>


    <script  src="/public/js/script.js"></script>
</body>
</html>