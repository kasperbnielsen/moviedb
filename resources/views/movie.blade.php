<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="genreslist.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
  <div id="includesearch">
    @include('search')
  </div>
  <div id="innerbody">
    <div id="title-div">
      <div id="title">
        <h1><?php echo $data->title; ?></h1>
        <ul id=under-title-div>
          <a><?php echo substr($data->release_date, 0, 4); ?></a>
          <li><?php echo intval(($data->runtime) / 60);
              echo "h ";
              echo ($data->runtime % 60);
              echo "m"; ?></li>
        </ul>
      </div>
      <h3><span class="fa fa-star checked"></span><?php echo substr($data->vote_average, 0, 3) ?> / 10</h3>
      <h3 id="popularity-header"><i class="fa fa-eye"></i><?php echo intval($data->popularity) ?></h3>
    </div>
    <div id="backdrop">
      <?php
      print_r('<img src="https://image.tmdb.org/t/p/w500' . $data->poster_path . '"/>');
      //print_r('<iframe width="600" height="600" src="https://www.youtube.com/embed/' . $data->key . '?controls=0&autoplay=1&mute=1"></iframe>');
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
      print_r("<p>$data->overview</p>")
      ?>
    </div>
    <div>
      <h4 id="commentsheader">Reviews</h4>
    </div>
    <script>
      var data = <?php echo $data->id; ?>;
      $.ajax({
        url: '/api/movie/video/' + data,
        type: "GET",
        success: (result) => {
          console.log(result)
          var backdrop = document.querySelector('#backdrop');
          backdrop.innerHTML += `<iframe src="https://www.youtube.com/embed/${result.results[0].key}?controls=0&autoplay=0&mute=1"></iframe>`
        }
      })
    </script>
  </div>
</body>

</html>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

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
  }

  #title-div {
    display: flex;
  }

  h3 {
    color: white;
    font-size: 14px;
    font-weight: 700;
    text-align: center;
    margin-top: 1.5rem;
  }

  h3:before {
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