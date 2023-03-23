<?php ob_start(); ?>

<main class="container d-flex flex-column align-items-center gap-5">
  <h1 class="display-4 fst-italic fw-bold text-center ">
    <?= $subject->name ?>
  </h1>

  <div class="accordion mb-5 col-6" id="newSubject">
    <div class="accordion-item">
      <h2 class="accordion-header  " id="headingOne">
        <button class="accordion-button text-center fs-5 fw-bold collapsed shadow" type="button"
          data-bs-toggle="collapse" data-bs-target="#formSubject" aria-expanded="true" aria-controls="collapseOne">
          Nouveau commentaire
        </button>
      </h2>
      <div id="formSubject" class="accordion-collapse collapse" aria-labelledby="headingOne"
        data-bs-parent="#newSubject">
        <div class="accordion-body d-flex justify-content-center">

          <form class="  col-md-12 col-lg-12 d-flex justify-content-center align-items-center" action="" method="post"
            style="height: auto;">

            <div class="d-flex flex-column align-items-center justify-content-between col-12 col-md-8">
             
              <div class="w-100">
                <div class="mb-4  rounded-2 position-relative d-flex flex-column">

                  <label for="commentaire" class="fw-bold text-info">Mon commentaire :</label>
                  <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="commentaire" name="commentaire"></textarea>
                    <label for="floatingTextarea" class="text-body-tertiary ">Mon commentaire</label>
                  </div>

                <!--   <input name="subject_name" type="text" class="form-control  col-lg-4" id="name"
                    aria-describedby="pseudoInput" placeholder="name"> -->
                </div>

              </div>

              <button type="submit" class="btn btn-primary ">Poster</button>

          </form>


        </div>
      </div>
    </div>
  </div>


  <!-- <div class="p-4 p-md-5 mb-4 rounded border shadow mt-5">
    <div class=" px-0 text-dark"> -->
      <?php /* echo 'Posts';
      var_dump($posts); */
      foreach ($posts as $key => $value) {
        ?>

        <div class="card mt-5" >
          <div class="card-body">
            <h5 class="card-title"><?= $value['post_author']; ?></h5>
            
            <p class="card-text">
              <?= $value['comment']; ?>
            </p>
            <a href="#" class="btn btn-outline-primary" >Répondre</a>
          </div>
        </div>

        <?php
      }
      ?>
    <!-- </div>
  </div> -->




</main>


<?php $content = ob_get_clean(); ?>

<?php require("./templates/layout.php"); ?>