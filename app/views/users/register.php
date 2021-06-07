<?php require_once APPROOT . '/views/layout/header.php' ?>
<br>

<div class="container col-md-4">
    <main class="form-signin">
        <form action="<?php echo URLROOT ?>/users/register" method="post">
            <div class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="68" height="68" fill="currentColor" class=" bi bi-box" viewBox="0 0 16 16">
                    <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                </svg>
            </div>
            <br>
            <h1 class="h3 mb-3 fw-normal text-center">Sign Up!</h1>

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

            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="name" value="<?php echo $data['name'] ?>">
                <label for="floatingInput">Name</label>
            </div>
            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="<?php echo $data['email'] ?>">
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" value="<?php echo $data['password'] ?>">
                <label for="floatingPassword">Password</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="confirm_password" value="<?php echo $data['confirm_password'] ?>">
                <label for="floatingPassword">Confirm Password</label>
            </div>

            <div class="checkbox mb-3 text-center">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
        </form>
    </main>

</div>


<?php require_once APPROOT . '/views/layout/footer.php';
