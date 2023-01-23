<h1><?php echo $H1_tag ?></h1>
<?php if (empty($toys)) : ?>
    <div>Aucun jouet a afficher</div>
<?php else : ?>
    <div class="d-flex flex-row flex-wrap justify-content-center col-6">
        <?php foreach ($toys as $toy): ?> 
            <div class="card m-2" style="width: 22rem">
                <img src="/img/<?php echo $toy->image ?>" class="card-img-top img-fluid p-3" alt="<?php echo $toy->name ?>">
                <div class="card-body">
                    <h3 class="card-title"><?php echo $toy->name ?></h3>
                    <p class="card-text"><?php echo $toy->price ?> €</p>
                    <a href="/jouet/<?= $toy->id ?>" class="btn btn-primary">Voir détail</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>