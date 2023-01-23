<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php 
        use App\AppRepoManager;
        use App\Session; 
        ?>
        <?= $title_tag ?>
    </title>

    <!-- CSS de base -->
    <link rel="stylesheet" href="/style.css">
    
    <!-- CDN Boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- import cdn icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.css"
        integrity="sha512-c0+vSv9tnGS4fzwTIBFPcdCZ0QwP+aTePvZeAJkYpbj67KvQ5+VrJjDh3lil48LILJxhICQf66dQ8t/BJyOo/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <?php if (!$auth::isAuth())
        $auth::redirect('/connexion'); ?>
    <div id="container">
        <header>
            <div class="logo"><a href="/"><img src="/img/logo.jpg"></div>
        </header>
        <div id="top-bar" class="d-flex flex-row justify-content-between">

            <div id="main-menu">
                <ul class="menu-root d-flex flex-row justify-content-center">
                    <?php if ($auth::isAdmin()): ?>
                        <li>
                            <a href="/admin">Accès Admin</a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a href="/">Tous les jouets</a>
                    </li>
                    <li>
                        <a href="#">Par marque
                            <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul>
                            <?php foreach (AppRepoManager::getRm()->getBrandRepo()->getBrandByName() as $r_brand) { ?>
                                <li>
                                    <a href="/brand/<?php echo $r_brand->id ?>">
                                        <?php echo $r_brand->name ?> ( <?php echo $r_brand->total_brand ?> )
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center m-2">
                <li>
                    <a href="/logout" class="logout">
                        <i class="bi bi-box-arrow-left"></i>
                    </a>
                </li>
            </div>
        </div>