<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<?php if (session()->has('user')) {
    $user = session('user');
} ?>

<body>
    @include('search')
    <div id="innerbody">
        <div id="title-div">
            <div id="title">
                <h1>
                    <?php echo $data->title; ?>
                </h1>
                <ul id="under-title-div">
                    <a>
                        <?php echo substr($data->release_date, 0, 4); ?>
                    </a>
                    <li>
                        <?php echo intval($data->runtime / 60);
                        echo 'h ';
                        echo $data->runtime % 60;
                        echo 'm'; ?>
                    </li>
                </ul>
            </div>
            <h3 class="h3"><span class="fa fa-star checked"></span>
                <?php echo substr($data->vote_average, 0, 3); ?> / 10
            </h3>
            <h3 class="h3" id="popularity-header"><i class="fa fa-eye"></i>
                <?php echo intval($data->popularity); ?>
            </h3>
        </div>
        <div id="backdrop">
            <?php
            print_r('<img src="https://image.tmdb.org/t/p/w500' . $data->poster_path . '"/>');
            ?>
        </div>
        <div id="genres">
            <?php foreach ($data->genres as $e) {
                print_r("<button class='genrebuttons'>{$e->name}</button>");
            }
            ?>
        </div>
        <h2>Overview</h2>
        <div id="overview">
            <?php
            print_r("<p>$data->overview</p>");
            ?>
        </div>
        <div>
            <h4 id="commentsheader">Reviews</h4>
            <div class=commentsForm>
                <form id="commentForm" type="submit">
                    <textarea id="commentInput" name="Text1" cols="40" rows="5" placeholder="What did you think of the movie"></textarea>
                    <button class="commentButton" type="submit">Submit</button>
                </form>
            </div>
            <div id="comments">

            </div>

        </div>
    </div>
</body>
<script>
    let comments = document.querySelector("#comments");
    let key = "<?php echo $key->results[0]->key; ?>";
    var backdrop = document.querySelector('#backdrop');
    backdrop.innerHTML += `<iframe src="https://www.youtube.com/embed/${key}?controls=0&autoplay=0&mute=1"></iframe>`;

    $.ajax({
        url: `/api/watchlist/${window.location.pathname.substr(7)}/${<?php echo $user->id ?>}`,
        method: "GET",
        success: (result) => {
            console.log(result);
        }
    })

    function postComment(movieId, body) {
        let userID = <?php if (session()->has('user')) {
                            echo $user->id;
                        } else {
                            echo 1;
                        } ?>;
        $.ajax({
            url: `/api/post/${movieId}/${body}/${userID}`,
            type: "GET",
            success: (result) => {
                console.log(result)
            }
        })
    }

    function deleteComment(commentsId) {
        $.ajax({
            url: `/api/delete/${commentsId}`,
            type: "GET",
            success: (result) => {
                refreshComments()
            }
        })
    }

    async function getUsername(userId) {
        /*** 
         * http call to endpoint querying database model User on userId getting the username
         * takes @String userId
         * return @String username
         */
        let data = await $.ajax({
            url: `/api/username/${userId}`,
            method: "GET",
            success: (result) => {
                console.log(result)
            }
        }).done((res) => {
            return res;
        })
        return data;
    }

    function refreshComments() {
        $.ajax({
            url: `/api/getmovie/${window.location.pathname.substr(7)}`,
            type: "GET",
            success: async (result) => {
                comments.innerHTML = ""
                for (let i = 0; i < result.length; i++) {
                    let name = await getUsername(result[i].userId);
                    comments.innerHTML +=
                        `<div class="commentsUser"><span>${name}</span>${new Date(result[i].created_at).toString().substr(4, 20)}</div><div class="comments"><p class="commentsBody"> ${result[i].body} </p><button onclick="deleteComment('${result[i].commentsId}')" id="commentsDelete"> X</button> </div>`
                }

            }
        })
    }

    document.querySelector("#commentForm").addEventListener('submit', (event) => {
        event.preventDefault();
        const input = document.querySelector("#commentInput").value;

        postComment(window.location.pathname.substr(7), input)
        refreshComments()
    })
    refreshComments();
</script>

</html>
<style scoped>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

    .comments {
        display: flex;
    }

    #commentInput {
        width: 30rem;
        height: 5rem;
        resize: none;
    }

    .commentsForm {
        margin-left: 3rem;
    }

    .commentsUser {
        margin-left: 2rem;
    }

    .commentsBody {
        width: 75rem;
        margin-left: 3rem;
        white-space: pre-wrap;
    }

    .commentsDelete {
        margin-left: 2rem;
        margin-top: 1rem;
    }

    iframe {
        aspect-ratio: 16 / 9;
        height: 600;
        width: 100%;
    }

    #backdrop,
    #title {
        display: flex;
        justify-content: left;
    }

    h1 {
        margin-bottom: -1rem;
    }

    #title {
        flex-direction: column;
        width: 20%;
        margin-right: 55rem;
    }

    img {
        width: 400px;
        height: 600px;
        border-radius: 2px;
    }

    #genres,
    h2,
    #overview {
        padding: 0 2rem 0 2rem
    }

    body {
        min-height: 100vh;
        height: 100%;
    }

    #genres {
        padding-bottom: 5vh;
        padding-top: 5vh;
    }

    .genrebuttons {
        background-color: #777;
        margin-right: 2vh;
        border-color: white;
        border-radius: 20px;
        padding: 5px 10px;
        font-weight: bold;
        color: white;
    }

    .genrebuttons:hover {
        background-color: #555;
    }

    #commentsheader {
        display: flex;
        justify-content: left;
        padding: 5rem 2rem 0 2rem;
    }

    body {
        background-color: #000;
        color: white;
        margin: 0;
        padding: 0;
    }

    * {
        font-family: Montserrat;
    }

    #innerbody {
        background-color: #111;
        height: 100%;
        margin: auto;
        padding: 0 2rem 0 2rem;
        max-width: 75%;
    }

    #under-title-div {
        display: flex;
        padding: 0;
    }

    #under-title-div>* {
        margin-right: 2rem;
        font-size: 0.8rem;
        opacity: 0.7;
    }

    #title-div {
        display: flex;
    }

    .h3 {
        color: white;
        font-size: 14px;
        font-weight: 700;
        text-align: center;
        margin-top: 1.5rem;
    }

    .h3:before {
        display: flex;
        opacity: 0.7;
        color: white;
        content: "RATING";
        margin-bottom: 0.5rem;
        font-weight: 400;
        font-size: 16px;
    }

    #popularity-header {
        margin-left: 3rem;
        color: white;
    }

    #popularity-header:before {
        content: "POPULARITY";
    }

    i {
        color: orange;
    }

    span {
        color: yellow
    }

    i,
    span {
        margin-right: 0.5rem;
    }
</style>