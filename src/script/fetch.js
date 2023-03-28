let response = document.querySelector("#newPost");
let data = document.querySelector("#result");
response.addEventListener('click', (e) => {
    e.preventDefault();


    fetch("./src/models/get_posts.php")

        .then(response => response.json())
        .then(response => {
            console.log(response), response.forEach(element => {
                let newPost = document.createElement('div');
                /*  newPost.classList.add("card-body,d-flex,flex-column,px-5,py-4,bg-white");*/

                newPost.innerHTML = '<div class="card col-8 mb-5"><div class="card-body d-flex flex-column px-5 py-4"><div class="d-flex align-items-center pe-3 py-3 mb-4"><div class="col-1"><img class="img-fluid rounded" src='+element.avatar+' alt="image avatar"></div><h5 class="card-title ms-4 mb-0">Chat Pardeur          </h5></div><p class="card-text bg-body-tertiary col-10 p-3 align-self-center">'+element.comment+'</p><div class="d-flex align-items-center"><p class="m-0">Posté le 28-03-2023 à 12:02:52          </p><button class="btn btn-primary col-2 ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#81" aria-expanded="false" aria-controls="81">Répondre</button></div><!-- Partie étendue --><div class=" collapse" id="81"><form class=" col-md-12 col-lg-12 d-flex justify-content-center align-items-center" action="" method="post"><div class="d-flex flex-column align-items-center justify-content-between col-12 col-md-8"><div class="w-100"><div class="mb-4  rounded-2 position-relative d-flex flex-column"><label for="commentaire" class="fw-bold text-info">Ma réponse :</label><div class="form-floating"><textarea class="form-control" placeholder="Leave a comment here" id="commentaire" name="comment"></textarea><label for="floatingTextarea" class="text-body-tertiary ">Mon commentaire</label></div></div></div><input type="hidden" name="parent_post_id" value="81"><button type="submit" name="response" class="btn btn-primary">Poster</button></div></form></div></div></div>';
                document.querySelector('main').appendChild(newPost);

            });
        })


})
