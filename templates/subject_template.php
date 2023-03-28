<?php ob_start(); ?>
<?= $_GET['subject_name'] ?>
<?php $title = ob_get_clean(); ?>

<?php ob_start(); ?>

<main class="container d-flex flex-column align-items-center gap-3">
  <h1 class="display-4 fst-italic fw-bold text-center mt-5 text-info text-shadow-info">
    <?= $post->subject_name ?>
  </h1>

  <div class="accordion mb-5 col-6" id="newSubject">
    <div class="accordion-item mt-3">
      <h2 class="accordion-header  " id="headingOne">
        <button class="accordion-button text-center fs-5 fw-bold collapsed border-0 whiteBorderFlash " type="button"
          data-bs-toggle="collapse" data-bs-target="#formSubject" aria-expanded="true" aria-controls="collapseOne">
          Nouveau commentaire
        </button>
      </h2>
      <div id="formSubject" class="accordion-collapse collapse" aria-labelledby="headingOne"
        data-bs-parent="#newSubject">
        <div class="accordion-body d-flex justify-content-center">

          <!-- Contenu de l'accordéon -->
          <form class="  col-md-12 col-lg-12 d-flex flex-column justify-content-center align-items-center" action=""
            method="post" style="height: auto;">

            <div class="d-flex flex-column align-items-center justify-content-between col-12 col-md-8">

              <div class="w-100">
                <div class="mb-4  rounded-2 position-relative d-flex flex-column">

                  <label for="commentaire" class="fw-bold text-info">Mon commentaire :</label>
                  <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="commentaire"
                      name="comment"></textarea>
                    <label for="floatingTextarea" class="text-body-tertiary ">Mon commentaire</label>
                  </div>

                </div>
              </div>
            </div>
            <button type="submit" name="new_post" id="newPost" class="btn btn-primary">Poster</button>

          </form>
          <div id="result">

          </div>

        </div>
      </div>
    </div>
  </div>



  <?php foreach ($posts as $key => $value) {
    ?>

    <div class="card col-8 mb-5">
      <div class="card-body d-flex flex-column px-5 py-4">
        <div class="d-flex align-items-center pe-3 py-3 mb-4">
          <div class="col-1"><img class='img-fluid rounded' src="<?= $value['avatar'] ?>" alt="image avatar"></div>
          <h5 class="card-title ms-4 mb-0">
            <?= $value['post_author']; ?>
          </h5>
        </div>
        <?php if (isset($value["parent_post_id"]) && $value["parent_post_id"] > 0) {
          foreach ($posts as $key2 => $value2) {
            if ($value['parent_post_id'] == $value2['id']) { ?>
              <p>En réponse à : </p>
              <div class="card col-8 mb-5">
                <div class="card-body d-flex flex-column ">

                  <h5 class="card-title">
                    <?= $value2['post_author']; ?>
                  </h5>
                  <p class="card-text bg-body-tertiary col-10 p-3 align-self-center">
                    <?= $value2['comment']; ?>
                  </p>

                  <div class='d-flex align-items-center'>
                    <p class='m-0'>
                      <?php echo 'Posté le ' . date("d-m-Y", strtotime($value2["date"])) . ' à ' . date("H:i:s", strtotime($value2["date"])) ?>
                    </p>

                  </div>
                </div>
              </div>
            <?php }
          }
        }
        ; ?>
        <p class="card-text bg-body-tertiary col-10 p-3 align-self-center">
          <?= $value['comment']; ?>
        </p>

        <div class='d-flex align-items-center'>
          <p class='m-0'>
            <?php echo 'Posté le ' . date("d-m-Y", strtotime($value["date"])) . ' à ' . date("H:i:s", strtotime($value["date"])) ?>
          </p>
          <button class="btn btn-primary col-2 ms-auto" type="button" data-bs-toggle="collapse" data-bs-target=<?= '#' . $value['id'] ?> aria-expanded="false" aria-controls=<?= $value['id'] ?>>
            Répondre
          </button>
        </div>
        <!-- Partie étendue -->
        <div class=" collapse" id=<?= $value['id'] ?>>
          <form class=" col-md-12 col-lg-12 d-flex justify-content-center align-items-center" action="" method="post">

            <div class="d-flex flex-column align-items-center justify-content-between col-12 col-md-8">

              <div class="w-100">
                <div class="mb-4  rounded-2 position-relative d-flex flex-column">

                  <label for="commentaire" class="fw-bold text-info">Ma réponse :</label>
                  <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="commentaire"
                      name="comment"></textarea>
                    <label for="floatingTextarea" class="text-body-tertiary ">Mon commentaire</label>
                  </div>
                </div>
              </div>
              <input type="hidden" name="parent_post_id" value="<?= $value["id"] ?>">
              <button type="submit" name="response" class="btn btn-primary">Poster</button>

          </form>
        </div>
      </div>
    </div>
    </div>
    <?php
  }
  ?>





</main>


<?php $content = ob_get_clean(); ?>

<?php require("./templates/layout.php"); ?>