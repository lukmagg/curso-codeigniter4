<?= view("dashboard/partials/_form-error") ?>


<form action="<?= base_url() ?>/movie/update/<?= $movie->id ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <?= view("dashboard/movie/_form", ['textButton' => 'Actualizar', 'created' => false]) ?>
</form>

<?= view("dashboard/movie/_images") ?>