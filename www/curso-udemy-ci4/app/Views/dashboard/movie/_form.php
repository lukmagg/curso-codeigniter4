<?= 'dashboard/movie/_form'; echo '<br>'; echo '<br>'; ?>


<div class="form-group">
    <label for="title">Title</label>
    <input class="form-control" type="input" name="title" id="title" value="<?= old('title', $movie->title) ?>" /><br />
</div>

<div class="form-group">
    <label for="description">Descripcion</label>
    <textarea class="form-control" name="description" id="description"><?= old('description', $movie->description) ?></textarea><br />
</div>

<br>
<div class="form-group">
    <label for="category_id">Categoria</label>
    <select class="form-control" name="category_id" id="category_id">
        <?php foreach ($categories as $c): ?>
            <option <?= $c->id == $movie->category_id ? 'selected' : '' ?> value="<?= $c->id ?>"><?= $c->title ?></option>
        <?php endforeach; ?>
    </select>
</div>

<br>
<br>

<?php if(!$created): ?>
    <div class="form-group">
        <label for="image">Image</label>
        <input class="form-control" type="file" name="image">
    </div>
<?php endif ?>

<input class="btn btn-success" type="submit" name="submit" value="<?= $textButton ?>" />


