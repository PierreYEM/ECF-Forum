<?php $title = "Inscription"; ?>

<?php ob_start(); ?>

<nav class="d-flex justify-content-center align-items-center bg-danger position-sticky">
    <h2 class="text-white">Error</h2>
</nav>

<?php $nav = ob_get_clean(); ?>

<?php ob_start(); ?>

<main class="container p-5 d-flex justify-content-center register">

    <div class="erreur col-6 p-4 p-md-5 mb-4 d-flex flex-column align-items-center rounded  shadow-lg  text-white">
        <p>
            <?= $errorMessage; ?>
        </p>
        <button class="btn btn-info col-6 mx-auto px-4" onclick="history.back()">Retour</button>

    </div>

</main>




<?php $content = ob_get_clean(); ?>

<?php require("./templates/layout.php"); ?>