<main>
    <h1>
        <?php echo $list_title ?>
    </h1>
    <?php if (empty($toys_list)): ?>
        <div>Aucun jouet en ce moment</div>
    <?php else: ?>
        <ul>
            <?php foreach ($toys_list as $toy): ?>
                <li>
                    <?php echo $toy ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</main>