<?php $title = "Connexion"; ?>

<?php ob_start(); ?>

<nav class="d-flex justify-content-center align-items-center position-sticky">
    <h2 class="text-white">Mon profil</h2>
</nav>

<?php $nav = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="container py-5 col-8 d-flex justify-content-center">

    <form class="d-flex flex-column align-items-center col-10 col-lg-6 " action="index.php?action=submitModifyUser" method="post">
      <h2 class="text-center">Informations de l'utilisateur</h2>
      <div class="d-flex flex-column align-items-center justify-content-between col-12 col-md-8 p-5"
        style="height:50vh;">
        <div class="w-100">
          <div class="mb-4 border rounded-2 position-relative">
            <i class="fa-regular fa-user ps-5 position-absolute top-50 translate-middle"></i>
            <input name="pseudo" type="text" class="form-control border-0 ps-5" id="pseudo"
              aria-describedby="pseudoInput" value="<?= $result["name"] ?>">
          </div>

          <div class="mb-4  border rounded-2 position-relative">
            <i class="fa-regular fa-envelope ps-5 position-absolute top-50 translate-middle"></i>
            <input name="email" type="email" class="form-control border-0 ps-5" id="exampleInputEmail1"
              aria-describedby="emailHelp" value="<?= $result["mail"] ?>">
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

        <button type="submit" class="btn btn-primary col-6 ">Modifier</button>

      </div>
    </form>
  </div>


<?php $content = ob_get_clean(); ?>

<?php require("./templates/layout.php"); ?>