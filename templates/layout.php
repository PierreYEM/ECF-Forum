<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="Forum pour chats démoniaques">

    <script src="./src/script/script.js" defer></script>

    <!-- Fontstyle Satisfy -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <!-- CDN Bootstrap parce que je le vaux bien -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./src/style/main.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"
        defer>
        </script>


    <!-- CDN Fontawesome -->
    <script src="https://kit.fontawesome.com/2fe7c14157.js" crossorigin="anonymous" defer></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.google.com/specimen/Lobster">


    <title>
        <?= $title ?>
    </title>
</head>

<body>

    <header class="sticky-top bg-header">
        <nav class="navbar navbar-expand-md navbar-light d-flex  sticky-top">
            <div class="container-fluid px-4 d-flex justify-content-between">

                <div class="d-flex align-items-center justify-content-center">

                    <div class="ms-3  text-info text-shadow fw-bold fs-2 fst-italic">
                        Bla Bla Cat
                    </div>
                </div>


                <button class="navbar-toggler z-1" type="button" data-bs-toggle="collapse" data-bs-target="#navBar"
                    aria-controls="navBar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navBar">

                    <div class="d-flex flex-column flex-md-row align-items-center gap-3">

                        <a href="./index.php" class="nav-link px-2 text-dark rounded"><button type="button"
                                class="btn btn-outline-light ">Accueil</button></a>
                        <?php if (isset($_SESSION) && !empty($_SESSION)) { ?>
                            
                            
                            <a href="./index.php?action=account" class="nav-link px-2 text-dark rounded">Mon compte</a>
                            <button type="button" class="btn btn-danger">
                                <a href="./index.php?action=disconnect">Déconnexion</a>
                            </button>

                        <?php } else { ?>
                            <a href="./index.php?action=connect"><button type="button"
                                    class="btn btn-outline-light ">Connexion</button></a>
                            <a href="./index.php?action=test_register"><button type="button"
                                    class="btn btn-warning">Inscription </button></a>
                        <?php }
                        ; ?>
                    </div>

                </div>

            </div>
        </nav>

        <?php if (isset($nav))
            echo $nav; ?>


    </header>

    <div id="wrapper" class="d-flex align-items-center bg-black bg-gradient">
        <?= $content; ?>
    </div>
    <?php
    /* echo 'SESSION';
    var_dump($_SESSION);
    echo 'DATA';
    var_dump($data);
    echo 'CATEGORIES';
    var_dump($categories);
    echo 'TOPICS';
    var_dump($topics);
    echo 'SUBJECTS';
    var_dump($subjects);
    echo 'Posts';
    var_dump($posts);
    echo 'GET';
    var_dump($_GET);
    echo 'POST';
    var_dump($_POST);
    echo 'FILES';
    var_dump($_FILES);  */ ?>
    <footer class="z-3 d-flex flex-wrap justify-content-center align-items-center py-3 bg-footer sticky-bottom">

    </footer>
</body>



</html>