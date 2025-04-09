<div class="page-circles">
    <?php
	$currentUrl = $_SERVER['REQUEST_URI'];
	if ($page > 1) : ?>
        <?php
    
        $queryParams = array_merge($_GET, ['page' => $page - 1]); // Merge existing GET parameters with the new page parameter
        $newUrl = strtok($currentUrl, '?') . '?' . http_build_query($queryParams);
        ?>
        <a href="<?= $newUrl ?>"><div class="numbering-circle"><i class="far fa-chevron-left"></i></div></a>
    <?php endif; ?>

    <?php
    $sP = max(1, $page - 2);
    $eP = min($totalpages, $sP + 4);
    for ($i = $sP; $i <= $eP; $i++) {
        $queryParams = array_merge($_GET, ['page' => $i]);
        $newUrl = strtok($currentUrl, '?') . '?' . http_build_query($queryParams);
        if ($i == $page) {
            echo '<a href="' . $newUrl . '"><div class="numbering-circle active"><h6>' . $i . '</h6></div></a>';
        } else {
            echo '<a href="' . $newUrl . '"><div class="numbering-circle"><h6>' . $i . '</h6></div></a>';
        }
    }
    ?>

    <?php if ($page < $totalpages) : ?>
        <?php
        $queryParams = array_merge($_GET, ['page' => $page + 1]); // Merge existing GET parameters with the new page parameter
        $newUrl = strtok($currentUrl, '?') . '?' . http_build_query($queryParams);
        ?>
        <a href="<?= $newUrl ?>"><div class="numbering-circle"><i class="far fa-chevron-right"></i></div></a>
    <?php endif; ?>
</div>
