<?php ob_start(); ?>
Accueil
<?php $title = ob_get_clean(); ?>

<?php ob_start(); ?>

<main class="container">


    <div class="p-4 p-md-4 rounded border shadow">
        <h1 class="display-4 fst-italic fw-bold text-center mb-4">Toutes les catégories</h1>
        <div class=" px-0 col-lg-8 mx-auto text-dark accordion" id="categories">
            <?php foreach ($categories as $key => $value) {
                ?>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button position-relative collapsed shadow" type="button"
                            data-bs-toggle="collapse" data-bs-target="<?= '#' . $value['id'] ?>" aria-expanded="true"
                            aria-controls="collapseOne">
                            <h3 class='fs-5 mb-0 position-absolute start-50 top-50 translate-middle'>
                                <?= $value['category_name'] ?>
                            </h3>
                        </button>
                    </h2>
                    <!-- partie étendue -->
                    <div id="<?= $value['id'] ?>" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <?php foreach ($topics as $key => $value2) {
                                if ($value['id'] == $value2['category_id']) { ?>
                                    <a href="index.php?topic_id=<?= $value2['id'] ?>&cat=<?= $value2["category_name"] ?>"
                                        class="text-dark">
                                        <div class="card shadow p-3 text-center w-100 my-3">

                                            <?= $value2["topic_name"]; ?>

                                        </div>
                                    </a>
                                <?php }
                            }
                            ; ?>
                        </div>
                    </div>
                </div>


                <?php
            }
            ?>
        </div>
    </div>




</main>


<?php $content = ob_get_clean(); ?>

<?php require("./templates/layout.php"); ?>