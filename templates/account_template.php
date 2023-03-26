<?php $title = "Connexion"; ?>

<?php ob_start(); ?>

<nav class="d-flex justify-content-center align-items-center position-sticky bg-info">
  <h2 class="text-white m-0 py-2">Mon profil</h2>
</nav>

<?php $nav = ob_get_clean(); ?>

<!-- Module "mes topics" -->
<?php ob_start(); ?>

<div class="col-12">
  <h2 class="text-center fw-bold ">Mes topics</h2>
  <ul class="list-group">
    <?php foreach ($topics as $key => $value) { ?>

      <li class="list-group-item d-flex justify-content-between align-items-center  p-3">
        <p class="fw-bold m-0">
          <?= "Catégorie : " . $value["category_name"] ?>
        </p>
        <p class="border rounded-3 p-2 shadow mx-auto my-0 fw-bold subject" data-bs-toggle="modal" data-bs-target=<?= '#' . $value['id'] ?>>
          <?= $value["topic_name"] ?>
        </p>

        <form action="" method="post" class=" me-3">
          <input type="hidden" name="topic_id" value=<?= $value['id'] ?>>
          <button type="submit" name="delete_topic" class="btn btn-danger shadow"
            onclick="return confirm('Êtes vous sur de vouloir supprimer ?')">Supprimer</button>
        </form>
      </li>

      <!-- Modale -->
      <div class="modal fade" id=<?= $value['id'] ?> tabindex="-1" aria-labelledby=<?= $value['topic_name'] ?>
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
          <div class="modal-content">
            <div class="modal-header border-bottom-0 ">
              <div class="ms-auto">
                <h3 class="modal-title fs-3 ms-auto" id=<?= $value['category_name'] ?>>Catégorie : <?= $value['category_name'] ?></h3>
              </div>
              <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column align-items-center gap-3">

              <h4 class="fs-5 text-center">
                <?= $value['topic_name'] ?>
              </h4>

            </div>
            <div class="modal-footer border-top-0 d-flex flex-column">
              <div class="d-flex col-12 align-items-center px-3">
                <p class="mb-0 me-auto">
                  <?php echo 'Créé le ' . date("d-m-Y", strtotime($value["topic_date"])) . ' à ' . date("H:i:s", strtotime($value["topic_date"])) ?>
                </p>
                <button class="btn btn-primary ms-auto shadow" type="button" data-bs-toggle="collapse"
                  data-bs-target=<?= '#form' . $value['id'] ?> aria-expanded="false" aria-controls=<?= 'form' . $value['id'] ?>>
                  Modifier
                </button>
              </div>

              <div class=" collapse col-10" id=<?= 'form' . $value['id'] ?>>
                <form class="  col-md-12 col-lg-12 d-flex justify-content-center align-items-center" action=""
                  method="post" >

                  <div class="d-flex flex-column align-items-center justify-content-between col-12 col-md-8">
                    <p class="fw-bold text-info">Modifiez votre topic</p>
                    <div class="w-100">
                      <div class="mb-4 border rounded-2 position-relative">
                        <input name="edit_topic" type="text" class="form-control border-0 col-lg-4" id="name"
                          aria-describedby="edit_subject" placeholder="votre sujet modifié"
                          value="<?= $value['topic_name'] ?>">
                        <input type="hidden" name="topic_id" value=<?= $value['id'] ?>>
                      </div>

                    </div>

                    <button type="submit" name="modify_topic" class="btn btn-primary shadow" <?php if (empty($_SESSION)) {
                      echo "disabled";
                    } ?>>Valider</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>
      </div>

    <?php }
    ; ?>
  </ul>
</div>


<?php $userTopics = ob_get_clean(); ?>

<!-- Module "mes sujets" -->
<?php ob_start(); ?>

<div class="col-12">
  <h2 class="text-center fw-bold ">Mes sujets</h2>
  <ul class="list-group">
    <?php foreach ($subjects as $key => $value) { ?>

      <li class="list-group-item d-flex justify-content-between align-items-center  p-3">
        <p class="fw-bold m-0">
          <?= "Catégorie : " . $value["category_name"] ?>
        </p>
        <p class="border rounded-3 p-2 shadow mx-auto my-0 fw-bold subject" data-bs-toggle="modal" data-bs-target=<?= '#' . $value['id'] ?>>
          <?= $value["subject_name"] ?>
        </p>

        <form action="" method="post" class=" me-3">
          <input type="hidden" name="subject_id" value=<?= $value['id'] ?>>
          <button type="submit" name="delete_subject" class="btn btn-danger shadow"
            onclick="return confirm('Êtes vous sur de vouloir supprimer ?')">Supprimer</button>
        </form>
      </li>

      <!-- Modale -->
      <div class="modal fade" id=<?= $value['id'] ?> tabindex="-1" aria-labelledby=<?= $value['subject_name'] ?>
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
          <div class="modal-content">
            <div class="modal-header border-bottom-0 ">
              <div class="ms-auto">
                <h3 class="modal-title fs-3 ms-auto" id=<?= $value['category_name'] ?>>Catégorie : <?= $value['category_name'] ?></h3>
              </div>
              <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column align-items-center gap-3">

              <h4 class="fs-5 text-center">
                <?= $value['subject_name'] ?>
              </h4>

            </div>
            <div class="modal-footer border-top-0 d-flex flex-column">
              <div class="d-flex col-12 align-items-center px-3">
                <p class="mb-0 me-auto">
                  <?php echo 'Créé le ' . date("d-m-Y", strtotime($value["subject_date"])) . ' à ' . date("H:i:s", strtotime($value["subject_date"])) ?>
                </p>
                <button class="btn btn-primary ms-auto shadow" type="button" data-bs-toggle="collapse"
                  data-bs-target=<?= '#form' . $value['id'] ?> aria-expanded="false" aria-controls=<?= 'form' . $value['id'] ?>>
                  Modifier
                </button>
              </div>

              <div class=" collapse col-10" id=<?= 'form' . $value['id'] ?>>
                <form class="  col-md-12 col-lg-12 d-flex justify-content-center align-items-center" action=""
                  method="post" style="height: auto;">

                  <div class="d-flex flex-column align-items-center justify-content-between col-12 col-md-8">
                    <p class="fw-bold text-info">Modifiez votre sujet</p>
                    <div class="w-100">
                      <div class="mb-4 border rounded-2 position-relative">
                        <input name="edit_subject" type="text" class="form-control border-0 col-lg-4" id="name"
                          aria-describedby="edit_subject" placeholder="votre sujet modifié"
                          value="<?= $value['subject_name'] ?>">
                        <input type="hidden" name="subject_id" value=<?= $value['id'] ?>>
                      </div>

                    </div>

                    <button type="submit" name="modify_subject" class="btn btn-primary shadow" <?php if (empty($_SESSION)) {
                      echo "disabled";
                    } ?>>Valider</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>
      </div>

    <?php }
    ; ?>
  </ul>
</div>


<?php $userSubjects = ob_get_clean(); ?>

<!-- Module "mes posts" -->
<?php ob_start(); ?>

<div class="col-12">
  <h2 class="text-center fw-bold ">Mes posts</h2>
  <ul class="list-group">
    <?php foreach ($posts as $key => $value) { ?>

      <li class="list-group-item d-flex justify-content-between align-items-center p-3">
        <p class="fw-bold  m-0">
          <?= "Catégorie : " . $value["category_name"] ?>
        </p>
        <p class="border rounded-3 p-2 shadow mx-auto fw-bold m-0 post" data-bs-toggle="modal" data-bs-target=<?= '#' . $value['id'] ?>>
          <?= $value["subject_name"] ?>
        </p>

        <form action="" method="post" class="me-4">
          <input type="hidden" name="post_id" value=<?= $value['id'] ?>>
          <button type="submit" name="delete_post" class="btn btn-danger shadow"
            onclick="return confirm('Êtes vous sur de vouloir supprimer ?')">Supprimer</button>
        </form>

      </li>

      <!-- Modal -->
      <div class="modal fade" id=<?= $value['id'] ?> tabindex="-1" aria-labelledby=<?= $value['subject_name'] ?>
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
          <div class="modal-content">
            <div class="modal-header border-bottom-0 ">
              <div class="ms-auto">
                <h3 class="modal-title fs-3 ms-auto" id=<?= $value['category_name'] ?>>Catégorie : <?= $value['category_name'] ?></h3>
              </div>
              <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column align-items-center gap-3">

              <h4 class="fs-5 text-center">
                <?= $value['subject_name'] ?>
              </h4>

              <?php if (isset($value["parent_post_id"]) && $value["parent_post_id"] > 0) {
                foreach ($globalPosts as $key2 => $value2) {
                  if ($value['parent_post_id'] == $value2['id']) { ?>
                    <p>En réponse à : </p>
                    <div class="card col-8 mb-5">
                      <div class="card-body d-flex flex-column">

                        <h5 class="card-title">
                          <?= $value2['post_author']; ?>
                        </h5>
                        <p class="card-text bg-body-tertiary">
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

              <p class="d-flex p-3 bg-body-tertiary rounded-3 col-8">
                <?= $value['comment'] ?>
              </p>
            </div>

            <div class="modal-footer border-top-0 d-flex">
              <p class="mb-0 me-auto">
                <?php echo 'Créé le ' . date("d-m-Y", strtotime($value["date"])) . ' à ' . date("H:i:s", strtotime($value["date"])) ?>
              </p>
              <button class="btn btn-primary align-self-end me-4 shadow" type="button" data-bs-toggle="collapse"
                data-bs-target=<?= '#form' . $value['id'] ?> aria-expanded="false" aria-controls=<?= 'form' . $value['id'] ?>>
                Modifier
              </button>

              <div class=" collapse col-10" id=<?= 'form' . $value['id'] ?>>
                <form class=" col-md-12 col-lg-12 d-flex flex-column justify-content-center align-items-center" action=""
                  method="post">

                  <div class="d-flex flex-column align-items-center justify-content-between col-12 col-md-8">

                    <div class="w-100">
                      <div class="mb-4  rounded-2 position-relative d-flex flex-column">

                        <label for="commentaire" class="fw-bold text-info">Mon commentaire :</label>
                        <div class="form-floating">
                          <textarea class="form-control" placeholder="Leave a comment here" id="commentaire"
                            name="edit_comment"><?= $value['comment'] ?></textarea>
                          <label for="floatingTextarea" class="text-body-tertiary ">
                            Vos modifications
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="post_id" value=<?= $value['id'] ?>>
                  <button type="submit" name="modify_post" class="btn btn-primary shadow">Valider</button>

                </form>
              </div>

            </div>
          </div>
        </div>
      </div>


    <?php }
    ; ?>
  </ul>
</div>


<?php $userPosts = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="container mt-5 py-5 col-10 d-flex justify-content-center flex-column align-items-center gap-5">

  <div class="accordion mb-5 col-md-8 col-lg-6 col-xl-4" id="newSubject">
    <div class="accordion-item">
      <h2 class="accordion-header " id="headingOne">
        <button class="accordion-button text-center fs-5 fw-bold collapsed shadow" type="button"
          data-bs-toggle="collapse" data-bs-target="#formSubject" aria-expanded="true" aria-controls="collapseOne">
          Vos informations
        </button>
      </h2>
      <div id="formSubject" class="accordion-collapse collapse" aria-labelledby="headingOne"
        data-bs-parent="#newSubject">
        <div class="accordion-body d-flex justify-content-center">
          <form class="d-flex flex-column align-items-center col-10 col-md-12 col-lg-10 " action="" method="post">
            <div class="d-flex flex-column align-items-center justify-content-between col-12 col-md-8  col-lg-10 mt-3">
              <div>
                <div class="mb-4 border rounded-2 position-relative">
                  <i class="fa-solid fa-cat ps-5 position-absolute top-50 translate-middle"></i>
                  <input name="name" type="text" class="form-control border-0 ps-5" id="name" aria-describedby="name"
                    value="<?= $user->name ?>">
                </div>

                <div class="mb-4  border rounded-2 position-relative">
                  <i class="fa-regular fa-envelope ps-5 position-absolute top-50 translate-middle"></i>
                  <input name="mail" type="email" class="form-control border-0 ps-5" id="mail" aria-describedby="mail"
                    value="<?= $user->mail ?>">
                </div>

                <div class="mb-4 border rounded-2 position-relative">
                  <i class="fa-regular fa-eye-slash ps-5 position-absolute top-50 translate-middle"></i>
                  <input name="password" type="password" class="form-control border-0 ps-5" id="password"
                    aria-describedby="password" placeholder="mot de passe">
                </div>

                <div class="mb-4 border rounded-2 position-relative">
                  <i class="fa-regular fa-eye-slash confirm ps-5 position-absolute top-50 translate-middle"></i>
                  <input name="passwordConfirm" type="password" class="form-control border-0 ps-5" id="passwordConfirm"
                    aria-describedby="passwordConfirm" placeholder="confirmation">
                </div>

              </div>

              <button type="submit" name="modify_profil" class="btn btn-primary col-6 ">Modifier</button>


            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

  <?= $userTopics ?>

  <?= $userSubjects ?>

  <?= $userPosts ?>

</div>


<?php $content = ob_get_clean(); ?>




<?php require("./templates/layout.php"); ?>