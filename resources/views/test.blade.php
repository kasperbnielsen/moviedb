<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/d826f0fb4b.js" crossorigin="anonymous"></script>
</head>

<body>
  @include("search")
  <div id="innerbody">
    <div id="title-div">
      <h1>Popular movies</h1>
      <?php if (session()->has('user')) {
        $temp = session('user');
        echo $temp->name;
      }
      ?>
    </div>
    <div id="searchPoster"></div>
    <div id="poster-div">
      <button id="left-arrow" style="visibility: hidden"><i class="fa-solid fa-chevron-left"></i></button>
      <?php
      $data = session('data');
      $poster = session('poster');
      if (isset($data)) {
        for ($i = 0; $i < 6; $i++) {
          echo '<a class="redposter"><img class="redposterimg poster" src="https://image.tmdb.org/t/p/w500' . $data[$i]->poster_path . '"></a>';
        }
      }
      ?>
      <button id="right-arrow"><i class="fa-solid fa-chevron-right"></i></button>
    </div>
  </div>
  <script>
    let counter = 0;
    let data = <?php echo json_encode($data); ?>;

    let posterdiv = document.querySelectorAll('.redposterimg');
    let rightarrow = document.querySelector('#right-arrow');
    let leftarrow = document.querySelector('#left-arrow');
    rightarrow.addEventListener('click', (event) => {
      counter++;
      posterdiv.forEach((element, i) => {
        element.setAttribute('src', 'https://image.tmdb.org/t/p/w500' + data[i + counter].poster_path);
      })
      if (counter > 4) rightarrow.style.visibility = "hidden";
      else rightarrow.style.visibility = "visible";
      if (counter > 0) leftarrow.style.visibility = "visible";
      else leftarrow.style.visibility = "hidden";
    })

    leftarrow.addEventListener('click', (event) => {
      counter--;
      posterdiv.forEach((element, i) => {
        element.setAttribute('src', 'https://image.tmdb.org/t/p/w500' + data[i + counter].poster_path);
      })
      if (counter > 0) leftarrow.style.visibility = "visible";
      else leftarrow.style.visibility = "hidden"
      if (counter > 4) rightarrow.style.visibility = "hidden"
      else rightarrow.style.visibility = "visible";
    })



    document.querySelector("#form").addEventListener("submit", (event) => {
      event.preventDefault();
      const input = document.querySelector("#input").value;
      $.ajax({
        url: 'api/test/' + input,
        type: "GET",
        success: (result) => {
          document.querySelector('#searchPoster').innerHTML += `<img class="poster" src="https://image.tmdb.org/t/p/w500${result}">`
        }
      })
    });


    var posters = document.querySelectorAll(".redposter");

    posters.forEach((element, i) => {
      element.addEventListener('click', (event) => {
        window.location.href = '/movie/' + data[i + counter].id;
      })
    })
  </script>
</body>

</html>
<style>
  #image {
    display: flex;
  }

  body {
    background-color: #000;
    color: white;
    margin: 0;
    padding: 0;
    min-height: 100vh;
    height: 100%;
  }

  h1 {
    font-size: 26px;
  }

  #innerbody {
    background-color: #111;
    margin: auto;
    min-height: inherit;
    height: inherit;
    padding: 0 2rem 0 2rem;
    max-width: 75%;
    display: flex;
    flex-direction: column;
  }

  .poster {
    width: 150px;
    height: 225px;
    padding: 1vh;
    margin: 0 1rem 0 1rem;
  }

  .redposter {
    background-color: #222;
  }

  #poster-div {
    display: flex;
    place-content: center;
  }

  #title-div {
    margin-top: 2rem;
    margin-left: 9rem;
  }

  #right-arrow {
    display: flex;
    place-self: center;
  }

  #left-arrow {
    display: flex;
    place-self: center;
  }

  #left-arrow,
  #right-arrow {
    border: none;
    background: none;
  }

  .fa-solid {
    color: white;
  }

  #right-arrow:hover,
  #left-arrow:hover {
    opacity: 0.8;
  }
</style>