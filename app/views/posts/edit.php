<?php require_once APPROOT . '/views/layout/header.php' ?>


<?php
//Dumb code for dumb thing
$data_err = $data['data_err'];

$data_errors = [];

foreach ($data_err as $error => $value)
{
    if(!empty($value))
    {
        $data_errors[] = $value;
    }
}

?>

<?php if(!empty($data_errors)) : ?>

    <div class="alert alert-danger" role="alert">
        <br>
        <ul>
            <?php foreach ($data_errors as $error) : ?>
                <li>
                    <?php echo $error ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

    <div class="container">
        <div class="row">

            <div class="col-md-8">

                <h1>Create post</h1>

                <form action="/posts/edit/<?php echo $data['id'] ?>" method="POST">
                    <div class="form-group">
                        <label for="title">Title <span class="require">*</span></label>
                        <input type="text" class="form-control" name="title" id="title" value="<?php echo $data['title'] ?>" />
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea rows="5" class="form-control" name="description" id="description"><?php echo $data['description'] ?></textarea>
                    </div>

                   <br>

                    <div class="form-group">
                        <button type="submit" class="btn btn-danger">
                            Update
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>


<?php require_once APPROOT . '/views/layout/footer.php';
