<?php require_once APPROOT . '/views/layout/header.php'; ?>


<?php
if(empty($data['id'])) die("404")
?>

<!-- Begin page content -->
<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5"><?php echo $data['post']->title; ?></h1>
        <p class="lead"><?php echo $data['post']->body; ?> <br> <b>on</b> <?php echo $data['post']->created_at; ?>
            written By <a href=""><?php echo User::findUserById($data['post']->user_id)->name ?></a>
        </p>
        <?php if($data['post']->user_id == $_SESSION['user_id']) :?>

        <a href="/posts/edit/<?php echo $data['post']->id ?>"><button class="btn btn-success">edit</button></a>
        <?php endif ?>
    </div>
</main>


<?php require_once APPROOT . '/views/layout/footer.php'; ?>
