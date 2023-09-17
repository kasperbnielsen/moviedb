<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<header class="search">
      <a class="menu">menu</a>
      <form id="form" type="submit" action="/test" method="get">
        <input id="input" type="search" class="searchinput" name="query" />
        <button class="searchbutton" type="submit"></button>
      </form>
      <a class="menu">Login</a>
    </header>
    <div id="searchPoster"></div>
    <?php
        $index = 0;
        $data = session('data');
        $poster = session('poster');
        if(isset($data)) {
            for($i = 0; $i < 6; $i++) {
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

        posters.forEach((element, i) => {
              element.addEventListener("click", (event) => {
                <?php 
                  $id = $data[$index]->id;
                  $index++;
                  ?>
                window.location.href = `movie/` + <?php echo $id; ?>
              });
            });
        
       /*var posters = document.querySelectorAll(".redposter");

            posters.forEach((element, i) => {
              element.addEventListener("click", (event) => {
                var data = result.results[i];
                sessionStorage.setItem("posterpath", data.poster_path);
                sessionStorage.setItem("title", data.title);
                sessionStorage.setItem("overview", data.overview);
                sessionStorage.setItem("id", data.id);
                sessionStorage.setItem("genres", data.genre_ids);
                window.location.href = `movie/${element.id}`;
              });
            });
        //}*/
    </script>
</body>
</html>
<style>
  .searchbutton {
    background: none;
    border: none;
    position: relative;
  }

  .searchinput {
    width: 140vh;
  }

  .search {
    display: flex;
  }

  #image {
    display: flex;
  }
  body {
    display: block;
  }

  form {
    color: #555;
    display: flex;
    border: 1px solid currentColor;
    border-radius: 5px;
  }
  input[type="search"] {
    border: none;
    background: transparent;
    margin: 0;
    padding: 7px 8px;
    font-size: 14px;
    color: inherit;
  }
  button[type="submit"] {
    text-indent: -999px;
    overflow: hidden;
    width: 40px;
    padding: 0;
    margin: 0;
    border: 1px solid transparent;
    border-radius: inherit;
    background: transparent
      url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'%3E%3C/path%3E%3C/svg%3E")
      no-repeat center;
    cursor: pointer;
    opacity: 0.7;
  }
  button[type="submit"]:hover {
    opacity: 1;
  }

  form.nosubmit {
    border: none;
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

  .menu {
    text-transform: capitalize;
    text-decoration: underline;
    font-size: large;
    padding-top: 0.5vh;
    padding-right: 12.5vh;
    padding-left: 12.5vh;
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