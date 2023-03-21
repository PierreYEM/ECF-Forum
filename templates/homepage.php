<?php ob_start(); ?>

<main class="container">
    <h1 class="display-4 fst-italic fw-bold text-center ">Tous les topics</h1>

    <div class="p-4 p-md-5 mb-4 rounded border shadow">
        <div class=" px-0 text-dark">
            <?php
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="card shadow p-3 text-center w-100">

                    <?= $row["name"]; ?>

                </div>

                <?php
            }
            ?>
        </div>
    </div>




</main>


<?php $content = ob_get_clean(); ?>

<?php require("./templates/layout.php"); ?>