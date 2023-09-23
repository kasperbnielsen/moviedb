<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
  @include("search")
  <div id="searchPoster"></div>
  <?php
  $data = session('data');
  $poster = session('poster');
  if (isset($data)) {
    for ($i = 0; $i < 6; $i++) {
      echo '<a class="redposter"><img class="poster" src="https://image.tmdb.org/t/p/w500' . $data[$i]->poster_path . '"></a>';
    }
  }
  ?>
  <script>
    document.querySelector("#form").addEventListener("submit", (event) => {
      event.preventDefault();
      const input = document.querySelector("#input").value;
      console.log(input)
      $.ajax({
        url: 'api/test/' + input,
        type: "GET",
        success: (result) => {
          document.querySelector('#searchPoster').innerHTML += `<img class="poster" src="https://image.tmdb.org/t/p/w500${result}">`
        }
      })
    });


    var posters = document.querySelectorAll(".redposter");

    <?php for ($i = 0; $i < 6; $i++) { ?>
      posters[<?php echo $i ?>].addEventListener("click", (event) => {
        <?php $id = $data[$i]->id; ?>
        window.location.href = `/movie/` + "<?php echo $id; ?>"
      });
    <?php } ?>
  </script>
</body>

</html>
<style>
  #image {
    display: flex;
  }

  body {
    display: block;
    margin: 0;
    padding: 0;
  }

  .nav {
    display: none;
    border: 1px solid black;
    height: fit-content;
    width: 29vh;
    position: absolute;
    background-color: grey;
  }

  .nav a {
    display: flex;
    flex-direction: row;
    padding-top: 1vh;
    padding-bottom: 1vh;
    justify-content: center;
    border: 1px solid black;
    font-weight: bold;
  }

  .poster {
    width: 150px;
    height: 225px;
    padding: 1vh;
    margin-left: 5vh;
  }

  #image {
    margin-left: 30vh;
    margin-right: 30vh;
    background-color: #555;
  }

  h1 {
    margin-left: 30vh;
    margin-top: 10vh;
    margin-right: 30vh;
  }
</style>