<?php $title = "Connexion"; ?>

<?php ob_start(); ?>

<nav class="d-flex justify-content-center align-items-center position-sticky">
    <h2 class="text-white">Connexion</h2>
</nav>

<?php $nav = ob_get_clean(); ?>

<?php ob_start(); ?>

<div class="container d-flex justify-content-center  connect">
    <form class=" col-10 col-md-6 col-lg-4 d-flex justify-content-center align-items-center"
        action="index.php?action=submitConnect" method="post">

        <div class="d-flex flex-column align-items-center justify-content-between col-12 col-md-8">
            <div class="w-100">
                <div class="mb-4  border rounded-2 position-relative">
                    <i class="fa-regular fa-envelope ps-5 position-absolute top-50 translate-middle"></i>
                    <input name="email" type="email" class="form-control border-0 ps-5" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="email">
                </div>

                <div class="mb-4 border rounded-2 position-relative">
                    <i class="fa-regular fa-eye-slash ps-5 position-absolute top-50 translate-middle"></i>
                    <input name="password" type="password" class="form-control border-0 ps-5" id="password"
                        aria-describedby="password" placeholder="mot de passe">
                </div>

            </div>

            <button type="submit" class="btn btn-primary  ">Se connecter</button>

        </div>
    </form>
</div>


<?php $content = ob_get_clean(); ?>

<?php require("./templates/layout.php"); ?>