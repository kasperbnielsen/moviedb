<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="genreslist.js"></script>
  </head>
  <body>
    <div id="title"></div>
    <div id="backdrop"></div>
    <div id="genres"></div>
    <h2>Overview</h2>
    <div id="overview"></div>
    <script>
      var accessToken =
        "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI3MzU2ZjZjNzgxZjg0MjAyNjM2N2I4YmFhMjI1YWJkYiIsInN1YiI6IjY1MDFjOTdkNTU0NWNhMDBhYjVkYmRkOSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.zvglGM1QgLDK33Dt6PpMK9jeAOrLNnxClZ6mkLeMgBE";
      var overview = sessionStorage.getItem("overview");
      var title = sessionStorage.getItem("title");
      var posterpath = sessionStorage.getItem("posterpath");
      var id = sessionStorage.getItem("id");
      var genres = sessionStorage.getItem("genres");
      console.log(genres);

      document.querySelector("#title").innerHTML = "<h1>" + title + "</h1>";
      document.querySelector("#overview").innerHTML = overview;
      var backdropdiv = document.querySelector("#backdrop");
      var genresdiv = document.querySelector("#genres");
      backdropdiv.innerHTML += `<img src="https://image.tmdb.org/t/p/w500${posterpath}"/>`;
      $.ajax({
        url: `https://api.themoviedb.org/3/movie/${id}/videos`,
        type: "GET",
        beforeSend: (req) => {
          req.setRequestHeader("Authorization", accessToken);
        },
        success: (result) => {
          backdropdiv.innerHTML += `<iframe width="600" height="600" src="https://www.youtube.com/embed/${result.results[0].key}?controls=0&autoplay=1&mute=1"></iframe>`;
          console.log(result.results[0]);
          console.log(typeof genres);
          let temp = genres.split(",");
          temp.forEach((element) => {
            genrenames.genres.forEach((e) => {
              if (element == e.id) {
                genresdiv.innerHTML += `<button class="genrebuttons" type="submit">${e.name}</button>`;
              }
            });
          });
        },
      });
    </script>
  </body>
</html>
<style>
  #backdrop,
  #title {
    display: flex;
    justify-content: center;
  }

  img {
    width: 400px;
    height: 600px;
  }

  #genres,
  h2,
  #overview {
    padding-left: 49vh;
    padding-right: 49vh;
  }

  body {
    height: 200vh;
  }

  #genres {
    padding-bottom: 5vh;
    padding-top: 5vh;
  }

  .genrebuttons {
    background-color: #777;
    margin-right: 2vh;
    border-radius: 20px;
    padding: 5px 10px;
    font-weight: bold;
  }

  .genrebuttons:hover {
    background-color: #555;
  }
</style>
