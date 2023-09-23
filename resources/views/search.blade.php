<header class="search">
  <a id="menu" class="menu">menu</a>
  <div>
    <form id="form" type="submit" action="/test" method="get">
      <input id="input" type="search" class="searchinput" name="query" autocomplete="off" />
      <button class="searchbutton" type="submit"></button>
    </form>
    <div id="dropdowndiv" class="dropdown"></div>
  </div>
  <a id="login" class="menu">Login</a>
</header>
<script>
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
<style>
  #dropdowndiv {
    width: 90rem;
    height: fit-content;
    display: flex;
    flex-direction: column;
    position: absolute;
    background-color: #999;
  }

  header {
    display: flex;
    position: relative;
    background-color: #333;
    max-width: 100%;
    padding: 2rem 0 2rem 0;
  }

  .menu {
    text-transform: capitalize;
    text-decoration: underline;
    font-size: large;
    padding-top: 0.5vh;
    margin: 0 5rem 0 5rem
  }



  form {
    color: #555;
    display: flex;
    border: 1px solid currentColor;
  }


  input[type="search"] {
    border: none;
    background: white;
    margin: 0;
    padding: 7px 8px;
    font-size: 14px;
    color: inherit;
    width: 90rem;
    border-radius: 2px;
  }

  button[type="submit"] {
    text-indent: -999px;
    overflow: hidden;
    width: 40px;
    padding: 0;
    margin: 0;
    border: 1px solid transparent;
    border-radius: inherit;
    background: transparent url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'%3E%3C/path%3E%3C/svg%3E") no-repeat center;
    cursor: pointer;
    opacity: 1;
    background-color: white;
  }

  button[type="submit"]:hover {
    opacity: 0.7;
  }

  form.nosubmit {
    border: none;
    padding: 0;
  }

  .dropdownitem {
    height: fit-content;
    border-bottom: 1px solid grey;
  }

  .dropdownimage {
    width: 4.5rem;
    height: 7rem;
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
</style>