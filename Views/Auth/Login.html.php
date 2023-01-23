<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Connexion</title>

    <!-- CDN Boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body class="d-flex justify-content-center">
    <div class="col-4 d-flex flex-column border p-3">
        <?php if ($auth::isAuth())
            $auth::redirect('/'); ?>
        <h1>Connexion</h1>
        <?php if ($form_result && $form_result->hasError()): ?>
            <div class="p-15 bg-warning">
                <?= $form_result->getError()[0]->getMessage() ?>
            </div>
        <?php endif ?>
        <form action="/login" method="post">
            <div class="mb-3">
                <label class="form-label">Email :</label>
                <input class="form-control" type="email" name="email">
                <br>
            </div>
            <div class="mb-3">
                <label class="form-label">Password :</label>
                <input class="form-control" type="password" name="password">
                <br>
            </div>
            <input class="btn btn-primary" type="submit" value="Let's GO">
        </form>
    </div>
</body>

</html>