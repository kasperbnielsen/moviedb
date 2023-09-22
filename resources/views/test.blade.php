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
      <div>
        <form id="form" type="submit" action="/test" method="get">
          <input id="input" type="search" class="searchinput" name="query" autocomplete="off" />
          <button class="searchbutton" type="submit"></button>
        </form>
        <div id="dropdowndiv" class="dropdown"></div>
      </div>
      <a class="menu">Login</a>
    </header>
    <div id="searchPoster"></div>
    <?php
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

          <?php for ($i = 0; $i < 6; $i++) {?>
              posters[<?php echo $i ?>].addEventListener("click", (event) => {
                <?php $id = $data[$i]->id; ?>
                window.location.href = `/movie/` + "<?php echo $id; ?>"
              });
          <?php } ?>
       











      const APIKEY = "7356f6c781f842026367b8baa225abdb";
      function setupDropdown() {
        let temp = document.querySelector("#dropdowndiv");
        let searchinput = document.querySelector(".searchinput");
        const whatever = (event) => {
          if (searchinput.value != "") {
            temp.style.display = "grid";
            temp.style.gridTemplateRows = 3;
          } else {
            temp.style.display = "none";
          }
        };
        searchinput.addEventListener("input", (event) => {
          temp.innerHTML = "";
          console.log(searchinput.value);
          $.ajax({
            url: `https://api.themoviedb.org/3/search/movie?query=${searchinput.value}&api_key=${APIKEY}`,
            type: "GET",
            success: (result) => {
              if (result) {
                result.results.slice(0, 5).forEach((element) => {
                  addMovieToDropdown(element.id);
                });
              }
            },
            error: (err) => {
              console.log(err);
            },
          });
          if (searchinput.value != "") {
            temp.style.display = "grid";
            temp.style.gridTemplateRows = 3;
          } else {
            temp.style.display = "none";
          }
        });
        window.addEventListener("load", whatever);
      }

      function addMovieToDropdown(id) {
        let accessToken =
          "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI3MzU2ZjZjNzgxZjg0MjAyNjM2N2I4YmFhMjI1YWJkYiIsInN1YiI6IjY1MDFjOTdkNTU0NWNhMDBhYjVkYmRkOSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.zvglGM1QgLDK33Dt6PpMK9jeAOrLNnxClZ6mkLeMgBE";
        $.ajax({
          url: `https://api.themoviedb.org/3/movie/${id}`,
          type: "GET",
          beforeSend: (req) => {
            req.setRequestHeader("Authorization", accessToken);
          },
          success: (result) => {
            let a = document.createElement("a");
            let title = document.createElement("h3");
            let year = document.createElement("h3");
            let actors = document.createElement("h3");
            let img = document.createElement("img");
            let div = document.createElement("div");
            let div2 = document.createElement("div");
            if (result.poster_path == null) {
              img.setAttribute(
                "src",
                "https://img.freepik.com/free-photo/abstract-luxury-plain-blur-grey-black-gradient-used-as-background-studio-wall-display-your-products_1258-63747.jpg?w=2000"
              );
            } else {
              img.setAttribute(
                "src",
                `https://image.tmdb.org/t/p/w500${result.poster_path}`
              );
            }
            img.setAttribute("class", "dropdownimage");
            div.appendChild(img);
            a.addEventListener("click", (event) => {
              var data = result;
              sessionStorage.setItem("posterpath", data.poster_path);
              sessionStorage.setItem("title", data.title);
              sessionStorage.setItem("overview", data.overview);
              sessionStorage.setItem("id", data.id);
              var genredata = "";
              data.genres.forEach((element) => {
                genredata += element.id + ",";
              });
              sessionStorage.setItem("genres", genredata);
              window.location.href = `movie/${data.id}`;
            });
            actors.setAttribute("id", "undertitle");
            year.setAttribute("id", "undertitle");
            year.textContent = result.release_date.substr(0, 4);
            title.textContent = result.title;
            actors.textContent = "Leonardo DiCaprio";
            div2.setAttribute("id", "div2");
            div2.appendChild(title);
            div2.appendChild(year);
            div2.appendChild(actors);
            div.appendChild(div2);
            div.setAttribute("class", "dropdownitem");
            div.setAttribute("id", "dropdowndiv2");
            a.appendChild(div);
            document.querySelector("#dropdowndiv").appendChild(a);
          },
        });
      }

      setupDropdown();
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

  #dropdowndiv {
    width: 140vh;
    height: fit-content;
    display: flex;
    flex-direction: column;
    position: fixed;
    background-color: #999;
  }

  .dropdown {
    width: 150vh;
  }

  .dropdownitem {
    height: fit-content;
    border-bottom: 1px solid grey;
  }

  .dropdownimage {
    width: 5%;
    height: 7%;
    padding: 0.5rem;
  }

  #dropdowndiv2 {
    display: flex;
  }

  .dropdowntitle {
    display: flex;
    justify-content: left;
  }

  #undertitle {
    font-weight: normal;
  }

  #div2 {
    margin-left: 2%;
  }
  </style>