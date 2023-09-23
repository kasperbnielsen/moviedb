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
  <div id="includesearch">
    @include('search')
  </div>
  <div id="innerbody">
    <div id="title">
      <h1><?php echo $data->title ?></h1>
    </div>
    <div id="backdrop">
      <?php
      print_r('<img src="https://image.tmdb.org/t/p/w500' . $data->poster_path . '"/>');
      //print_r('<iframe width="600" height="600" src="https://www.youtube.com/embed/' . $data->key . '?controls=0&autoplay=1&mute=1"></iframe>');
      ?>
    </div>
    <div id="genres">
      <?php foreach ($data->genres as $e) {
        print_r("<button class='genrebuttons' type='submit'>{$e->name}</button>");
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
    height: 200vh;
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

  #innerbody {
    background-color: #111;
    height: 100%;
    margin: auto;
    padding: 0 2rem 0 2rem;
    max-width: 75%;
  }

  #includesearch {}
</style>