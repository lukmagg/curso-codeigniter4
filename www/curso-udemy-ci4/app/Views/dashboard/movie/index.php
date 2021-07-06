<a href="<?= base_url() ?>/movie/new">Crear</a>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Categoria</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($movies as $key => $m): ?>
        <tr>
            <td><?= $m->id ?></td>
            <td><?= $m->title ?></td>
            <td><?= $m->category ?></td>
            <td>
                <a class="mt-2 btn btn-primary btn-sm" href="<?= base_url() ?>/movie/<?= $m->id ?>">Ver</a>
                <form action="<?= base_url() ?>/movie/delete/<?= $m->id ?>" method="post">
                    <input class="btn btn-danger btn-sm mt-2" type="submit" name="submit" value="Borrar" />
                </form>

                <a class="mt-2 btn btn-primary btn-sm" href="<?= base_url() ?>/movie/<?= $m->id ?>/edit">Editar</a>
            </td>
        </tr>
        
        <?php endforeach ?>
        
    </tbody>


    <?= $pager->links(); ?>


</table>