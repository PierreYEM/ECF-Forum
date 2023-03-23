<?php ob_start(); ?>

<main class="container d-flex flex-column align-items-center gap-5">
  <h1 class="display-4 fst-italic fw-bold text-center ">
    <?= $topic->name ?>
  </h1>

  <div class="accordion mb-5 col-6" id="newSubject">
    <div class="accordion-item">
      <h2 class="accordion-header  " id="headingOne">
        <button class="accordion-button text-center fs-5 fw-bold collapsed shadow" type="button"
          data-bs-toggle="collapse" data-bs-target="#formSubject" aria-expanded="true" aria-controls="collapseOne">
          Nouveau sujet
        </button>
      </h2>
      <div id="formSubject" class="accordion-collapse collapse" aria-labelledby="headingOne"
        data-bs-parent="#newSubject">
        <div class="accordion-body d-flex justify-content-center">

          <form class="  col-md-12 col-lg-12 d-flex justify-content-center align-items-center" action="" method="post"
            style="height: auto;">

            <div class="d-flex flex-column align-items-center justify-content-between col-12 col-md-8">
              <p class="fw-bold text-info">Entrez votre sujet</p>
              <div class="w-100">
                <div class="mb-4 border rounded-2 position-relative">
                  <input name="subject_name" type="text" class="form-control border-0 col-lg-4" id="name"
                    aria-describedby="pseudoInput" placeholder="name">
                </div>

              </div>

              <button type="submit" class="btn btn-primary " <?php if (empty($_SESSION)) {
                echo "disabled";
              } ?>>Créer</button>

          </form>


        </div>
      </div>
    </div>
  </div>


  <div class="p-4 p-md-5 mb-4 rounded border shadow">
    <div class=" px-0 text-dark">
      <?php echo 'subjects';
      var_dump($subjects);
      foreach ($subjects as $key => $value) {
        ?>
        <a href="index.php?subject_id=<?= $value['id'] ?>&cat=<?= $value['category_name'] ?>&subject_name=<?= $value['subject_name'] ?>"
          class="text-dark">
          <div class="card shadow p-3 text-center w-100 my-3">

            <?= $value["subject_name"]; ?>
            par "
            <?= $value["subject_author"]; ?> "

          </div>
        </a>

        <?php
      }
      ?>
    </div>
  </div>




</main>


<?php $content = ob_get_clean(); ?>

<?php require("./templates/layout.php"); ?>