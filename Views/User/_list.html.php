<h1><?= $H1_tag ?></h1>
<?php if (empty($users)) : ?>
    <div>Aucun utilisateur enregistrer</div>
    <?php else : ?>
        <div class="d-flex flex-row flex-wrap justify-content-center col-6">
            <?php foreach($users as $user) : 
                $role = $user->role === 1 ? 'Utilisateur' : 'Administrateur' ;
                ?>
                <div class="card w-75 m-2">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $user->email ?></h5>
                        <p class="card-text"><?php echo $role ?></p>
                        <a href="/admin/update_user/<?php echo $user->id ?>" class="btn btn-success">Modifier</a>
                        <a href="#" class="btn btn-danger">Supprimer</a>
                    </div>
                </div>
                <?php endforeach ?>
        </div>
        <?php endif ?>