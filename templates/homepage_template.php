<?php ob_start(); ?>
Accueil
<?php $title = ob_get_clean(); ?>

<?php ob_start(); ?>

<main class="container my-4">


    <div class="p-4 p-md-4 rounded shadow-white">
        <h1 class="display-4 fst-italic fw-bold text-center mb-4 text-info text-shadow-info">Toutes les catégories</h1>

        <div>


            <div class="accordion mb-5 col-6 mx-auto " id="newSubject">
                <div class="accordion-item border-0 shadow-white">
                    <h2 class="accordion-header  " id="headingOne">
                        <button class="accordion-button text-center fs-5 fw-bold collapsed border-0 whiteBorderFlash"
                            type="button" data-bs-toggle="collapse" data-bs-target="#formSubject" aria-expanded="true"
                            aria-controls="collapseOne">
                            Nouveau topic
                        </button>
                    </h2>
                    <!-- Partie étendue -->
                    <div id="formSubject" class="accordion-collapse collapse" aria-labelledby="headingOne"
                        data-bs-parent="#newSubject">
                        <div class="accordion-body d-flex justify-content-center bg-dark bg-gradient rounded-bottom">

                            <form class="  col-md-12 col-lg-12 d-flex justify-content-center align-items-center"
                                action="" method="post" style="height: auto;">
                                <fieldset class="col-6 d-flex flex-column align-items-center justify-content-center"
                                    <?php if (empty($_SESSION)) {
                                        echo "disabled";
                                    } ?>>
                                    <div class="d-flex flex-column align-items-center justify-content-between col-12">
                                        <p class="fw-bold text-info">Entrez votre topic</p>

                                        <select class="form-select mb-3" aria-label="Default select example"
                                            name="category_id">
                                            <option selected>Choisissez votre catégorie</option>
                                            <?php foreach ($categories as $key => $value) {
                                                ?>
                                                <option value="<?= $value['id'] ?>"><?= $value['category_name'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                        <div class="w-100">
                                            <div class="mb-4 border rounded-2 position-relative">
                                                <input name="topic_name" type="text"
                                                    class="form-control border-0 col-lg-4" id="name"
                                                    aria-describedby="pseudoInput" placeholder="Nom du topic">
                                            </div>

                                        </div>

                                        <button type="submit" name="new_topic" class="btn btn-primary ">Créer</button>
                                    </div>
                                </fieldset>
                            </form>


                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class=" px-0 col-lg-8 mx-auto text-dark accordion" id="categories">
            <?php foreach ($categories as $key => $value) {
                ?>

                <!-- Onglet de catégorie -->
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

                    <div id="<?= $value['id'] ?>" class="accordion-collapse collapse  rounded-bottom">
                        <div class="accordion-body bg-dark bg-gradient">
                            <?php foreach ($topics as $key => $value2) {
                                if ($value['id'] == $value2['category_id']) { ?>
                                    <a href="index.php?topic_id=<?= $value2['id'] ?>&topic_name=<?= $value2['topic_name'] ?>"
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