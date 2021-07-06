
<div class="row">
    <?php foreach($images as $i): ?>
        <div class="col-xl-4 col-md-6 col-sm-12 mt-3">
            <a href="<?= base_url(route_to('image_delete', $i->id)) ?>" type="button" class="btn btn-dark crud-images">
                <span aria-hidden="true">&times;</span>
            </a>
            <img class="img-fluid" src="<?= base_url(route_to('get_image', $i->movie_id, $i->image)) ?>">
        </div>
    <?php endforeach; ?>
</div>