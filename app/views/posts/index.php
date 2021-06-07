<?php require_once APPROOT . '/views/layout/header.php'; ?>


<main>

    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Posts</h1>
                <p class="lead text-muted">Here you can share your Posts or see the other users posts</p>
                <p>
                    <?php if(isSignedIn()) :?>
                    <a href="posts/add" class="btn btn-primary my-2">Add New Post</a>
                    <?php else: ?>
                        <a href="users/login">Login</a> To Share Post
                    <?php endif;?>
                </p>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <?php foreach ($data['posts'] as $post) :?>
                <div class="card card-body mb-3">
                    <h4 class="card-title"><?php echo $post->title; ?></h4>
                    <div class="bg-light p-2 mb-3">
                        Written by <?php echo User::findUserById($post->user_id)->name ?> on <?php echo $post->created_at; ?>
                    </div>
                    <p class="card-text"><?php echo $post->body; ?></p>
                    <a href="posts/show/<?php echo $post->id; ?>" class="btn btn-dark">More</a>
                </div>
            <?php endforeach;?>
        </div>
    </div>

</main>

<?php require_once APPROOT . '/views/layout/footer.php'; ?>
