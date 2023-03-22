<?php $title = "Inscription"; ?>

<?php ob_start(); ?>
<div class="toast align-items-center text-bg-success border-0 show top-50 start-50 translate-middle position-absolute z-3"
    role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body">
            <?= $success; ?>
        </div>
        <form action="index.php" class=" me-2 m-auto">
            <button type="submit" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
            <input type="hidden" name="close" value="true">
        </form>
    </div>
</div>

<?php $toast = ob_get_clean(); ?>

<?php ob_start(); ?>

<nav class="d-flex justify-content-center align-items-center bg-warning position-sticky">
    <h2 class="text-white">Inscription</h2>
</nav>

<?php $nav = ob_get_clean(); ?>

<?php ob_start();
if (isset($success))
    echo $toast; ?>

<main class="container p-5 d-flex justify-content-center ">

    <form class="col-10  col-md-6 col-lg-4 d-flex justify-content-center align-items-center"
        action="index.php?action=register" method="post" style="height: auto;">

        <div class="d-flex flex-column align-items-center justify-content-between col-12 col-md-8">
            <div class="w-100">
                <div class="mb-4 border rounded-2 position-relative">
                    <i class="fa-regular fa-user ps-5 position-absolute top-50 translate-middle"></i>
                    <input name="name" type="text" class="form-control border-0 ps-5" id="name"
                        aria-describedby="pseudoInput" placeholder="name">
                </div>

                <div class="mb-4  border rounded-2 position-relative">
                    <i class="fa-regular fa-envelope ps-5 position-absolute top-50 translate-middle"></i>
                    <input name="mail" type="email" class="form-control border-0 ps-5" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                        required>
                </div>

                <div class="mb-4 border rounded-2 position-relative">
                    <i class="fa-regular fa-eye-slash ps-5 position-absolute top-50 translate-middle"></i>
                    <input name="password" type="password" class="form-control border-0 ps-5" id="password"
                        aria-describedby="password" placeholder="mot de passe">
                </div>

                <div class="mb-4 border rounded-2 position-relative">
                    <i class="fa-regular fa-eye-slash confirm ps-5 position-absolute top-50 translate-middle"></i>
                    <input name="passwordConfirm" type="password" class="form-control border-0 ps-5"
                        id="passwordConfirm" aria-describedby="passwordConfirm" placeholder="confirmation">
                </div>

            </div>

            <button type="submit" class="btn btn-primary col-6 ">S'inscrire</button>

    </form>

</main>

<?php $content = ob_get_clean(); ?>

<?php require("./templates/layout.php"); ?>