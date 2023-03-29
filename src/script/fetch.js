let newPost_form = document.querySelector("#newPost");

let newCom = document.querySelector(".new-com");
let newSubject = document.querySelector("#newSubject");

let error = document.querySelector("#error");
let postCommentButton = document.querySelector("#postCommentButton");
let form_get_posts = new FormData();
let urlParams = new URLSearchParams(window.location.search);
let subject_id = urlParams.get('subject_id');

form_get_posts.append('subject_id', subject_id);
form_get_posts.append('comment', newCom.value);

newPost_form.addEventListener('submit', (e) => {
    e.preventDefault();
    console.log(newCom.value);
    if (newCom.value == null || newCom.value == "") {
        console.log("vide");

        error.classList.add("display");
        /* postCommentButton.classList.remove("shake-horizontal"); */
        postCommentButton.classList.add("shake-horizontal");
        postCommentButton.addEventListener('animationend', () => postCommentButton.classList.remove("shake-horizontal"));

    } else {
        error.classList.remove("display");

        let form_create_posts = new FormData();
        let user_id = 64;
        let parent_post_id = 0;
        let post_author = "Chat Pardeur";
        form_create_posts.append('subject_id', subject_id);
        form_create_posts.append('user_id', user_id);
        form_create_posts.append('comment', newCom.value);
        form_create_posts.append('post_author', post_author);
        form_create_posts.append('parent_post_id', parent_post_id);

        fetch("./src/models/create_post.php",
            {
                method: "POST",
                body: form_create_posts

            })

            .then(response => {
                console.log(response);
                fetch("./src/models/get_posts.php",
                    {
                        method: "POST",
                        body: form_get_posts

                    })

                    .then(response => response.json())
                    .then(response => {
                        console.log(response);
                        let newPost = document.createElement('div');
                        newPost.classList.add("card", "col-8", "mb-5");
                        newCom.value = "";

                        newPost.innerHTML = '<div class="card-body d-flex flex-column px-5 py-4"><div class="d-flex align-items-center pe-3 py-3 mb-4"><div class="col-1"><img class="img-fluid rounded" src=' + response.avatar + ' alt="image avatar"></div><h5 class="card-title ms-4 mb-0">' + response.post_author + '          </h5></div><p class="card-text bg-body-tertiary col-10 p-3 align-self-center">' + response.comment + '</p><div class="d-flex align-items-center"><p class="m-0">Posté le 28-03-2023 à 12:02:52          </p><button class="btn btn-primary col-2 ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#81" aria-expanded="false" aria-controls="81">Répondre</button></div><!-- Partie étendue --><div class=" collapse" id="81"><form class=" col-md-12 col-lg-12 d-flex justify-content-center align-items-center" action="" method="post"><div class="d-flex flex-column align-items-center justify-content-between col-12 col-md-8"><div class="w-100"><div class="mb-4  rounded-2 position-relative d-flex flex-column"><label for="commentaire" class="fw-bold text-info">Ma réponse :</label><div class="form-floating"><textarea class="form-control" placeholder="Leave a comment here" id="commentaire" name="comment"></textarea><label for="floatingTextarea" class="text-body-tertiary ">Mon commentaire</label></div></div></div><input type="hidden" name="parent_post_id" value="81"><button type="submit" name="response" class="btn btn-primary">Poster</button></div></form></div></div>';

                        newSubject.after(newPost);

                    });
            })

    }




})
