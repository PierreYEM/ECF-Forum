<?php $title = "Connexion"; ?>

<!-- élément nav -->
<?php ob_start(); ?>

<nav class="d-flex justify-content-center align-items-center position-sticky bg-info">
  <h2 class="text-white">Test de pré-inscription</h2>
</nav>

<?php $nav = ob_get_clean(); ?>

<!-- élément toast succès -->
<?php ob_start(); ?>
<div
  class="toast align-items-center text-bg-success border-0 show top-50 start-50 translate-middle position-absolute z-3"
  role="alert" aria-live="assertive" aria-atomic="true">
  <div class="d-flex">
    <div class="toast-body">
      <?= $success; ?>
    </div>

    <a href="index.php?action=register" class="me-2 m-auto"><button type="submit" class="btn-close btn-close-white "
        data-bs-dismiss="toast" aria-label="Close"></button></a>

  </div>
</div>

<?php $success_toast = ob_get_clean(); ?>

<!-- élément toast échec -->
<?php ob_start(); ?>
<div
  class="toast align-items-center text-bg-danger border-0 show top-50 start-50 translate-middle position-absolute z-3"
  role="alert" aria-live="assertive" aria-atomic="true">
  <div class="d-flex">
    <div class="toast-body">
      <?= $failed; ?>
    </div>

    <button type="submit" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
      aria-label="Close"></button>

  </div>
</div>

<?php $failed_toast = ob_get_clean(); ?>

<!-- Contenu principal de la vue -->
<?php ob_start();
if (isset($success))
  echo $success_toast;
if (isset($failed))
  echo $failed_toast; ?>
<div class="container py-5 col-8 d-flex justify-content-center">


  <div class="card col-12">
    <div class="card-header">
      <h5 class="text-center mt-2">Question pour JCVD</h5>
    </div>
    <div class="card-body">
      <form method="post" class=" d-flex flex-column align-items-center gap-5">
        <div class="form-group col-6">
          <label for="captcha" class="font-weight-bold mt-3">Combien font 1 + 1 ?</label>
          <input type="text" class="form-control mt-3 col-6" name="answer" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block align-self-center">Valider</button>
      </form>
    </div>
  </div>



  <?php if (isset($response)) {
    echo $response;
  } ?>
</div>


<?php $content = ob_get_clean(); ?>

<?php require("./templates/layout.php"); ?>