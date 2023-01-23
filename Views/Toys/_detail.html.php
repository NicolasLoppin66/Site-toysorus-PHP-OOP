<div class="d-flex flex-row flex-wrap justify-content-center col-6 m-3">
    <h1>
        <?= $title_tag ?>
    </h1>
    <div class="d-flex mt-3">
        <div class="col-4">
            <img src="/img/<?= $toys->image ?>" alt="<?= $toys->name ?>">
            <h3 class="text-success mt-3"><?= $toys->brand->name ?></h3>
        </div>
        <div col-8>
            <p>
                <?= $toys->description ?>
            </p>
        </div>
    </div>
</div>