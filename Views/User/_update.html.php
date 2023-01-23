<div class="col-4 d-flex flex-column border p-3">

    <h1>Modifier l'utilisateur</h1>
    <?php if ($form_result && $form_result->has_error()): ?>
        <div style="padding:15px;background-color:#faa;border:1px solid #c00;color:#c00">
            <?php echo $form_result->getErrors()[0]->getMessage() ?>
        </div>
    <?php endif ?>
    <form action="/update" method="post">
        <div class="mb-3">
            <input type="hidden" value="<?= $users->id ?>" name="id" class="form-control" id="email" aria-describedby="emailHelp">
            <input type="hidden" value="<?= $users->password ?>" name="password" class="form-control" id="password">
            <label for="email" class="form-label">Email</label>
            <input type="text" value="<?= $users->email ?>" name="email" class="form-control" id="email"
                aria-describedby="emailHelp">
        </div>
        <div class=" d-flex flex-column mb-3">
            <div>
                <label for="role" class="form-label">Son rôle:</label>
            </div>
            <div>
                <input type="radio" name="role" value="1" <?= $users->role == 1 ? 'checked' : '' ?>>
                <label for="role">Utilisateur</label>
            </div>
            <div>
                <input type="radio" name="role" value="2" <?= $users->role == 2 ? 'checked' : '' ?>>
                <label for="role">Administrateur</label>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
</div>