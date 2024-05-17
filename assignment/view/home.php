<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Coca Cola Demo
    <?php echo $page_title; ?>
  </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="stylesheet" href="./style.css" />

  <script type="importmap">
      {
        "imports": {
          "three": "https://cdn.jsdelivr.net/npm/three@0.164.1/build/three.module.js",
          "three/addons/": "https://cdn.jsdelivr.net/npm/three@0.164.1/examples/jsm/"
        }
      }
    </script>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-custom">
      <div class="container">
        <a class="navbar-brand py-3 fs-1" href="#">
          <div class="logo-text lh-1">Coca Cola</div>
          <div class="strapline h6">Life Tastes Good</div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item mx-2">
              <a id="navHome" class="nav-link fs-5" aria-current="page" href="#">Home</a>
            </li>

            <li class="nav-item mx-2">
              <a id="navModels" class="nav-link fs-5" href="#">Models</a>
            </li>
          </ul>

          <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
            <li class="nav-item mx-2">
              <a id="navAbout" class="nav-link fs-5" href="#">About</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <div id="homeContent" class="container col-xxl-8 px-4 py-5">
      <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
          <img src="./public/images/hero-img.jpg" class=" rounded d-block mx-lg-auto img-fluid" alt="Coca Cola Bottle"
            loading="lazy">
        </div>
        <div class="col-lg-6">
          <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Coca Cola Brand Stuff</h1>
          <p class="lead">Something something refreshing Coca Cola products. Explore them on our site</p>
          <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <button id="viewContentButton" type="button" class="btn btn-primary btn-lg px-4 me-md-2">View Our Products</button>
          </div>
        </div>
      </div>
    </div>
    </div>

    <div id="modelContainer" class="container px-2 py-5">
      <div class="card px-2 py-2 my-2 row">
        <div class="btn-group py-5" role="group" aria-label="Basic example">
          <button id="colaButton" type="button" class="btn btn-outline-danger col">Coca Cola</button>
          <button id="spriteButton" type="button" class="btn btn-outline-danger col">Sprite</button>
          <button id="drpepperButton" type="button" class="btn btn-outline-danger col">Dr. Pepper</button>
        </div>
        <div class="row">
          <canvas id="modelCanvas" class="position-relative w-75 h-100 col-7 py-2"></canvas>
          <div id="guiContainer" class="col-3 py-2"></div>
        </div>
      </div>

      <div class="row">
        <div id="coke-card" class="card">
          <div class="card-body">
            <h5 class="card-title">
              <?php echo $data[0]['modelTitle'] ?>
            </h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">
              <?php echo $data[0]['modelSubtitle'] ?>
            </h6>
            <p class="card-text">
              <?php echo $data[0]['modelDescription'] ?>
            </p>
          </div>
        </div>


        <div id="sprite-card" class="card">
          <div class="card-body">
            <h5 class="card-title">
              <?php echo $data[1]['modelTitle'] ?>
            </h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">
              <?php echo $data[1]['modelSubtitle'] ?>
            </h6>
            <p class="card-text">
              <?php echo $data[1]['modelDescription'] ?>
            </p>
          </div>
        </div>

        <div id="drpepper-card" class="card">
          <div class="card-body">
            <h5 class="card-title">
              <?php echo $data[2]['modelTitle'] ?>
            </h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">
              <?php echo $data[2]['modelSubtitle'] ?>
            </h6>
            <p class="card-text">
              <?php echo $data[2]['modelDescription'] ?>
            </p>
          </div>
        </div>
      </div>

    </div>

    <div id="aboutContent" class="container px-2 py-5">
      <h1 id="aboutHead"></h1>
      <h2 id="aboutSub"></h2>
      <p id="aboutText"></p>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script type="module" src="./main.js"></script>
  <script>


async function getJson() {
  const response = await fetch('./model/data.json');
  const obj = await response.json();
  
  document.getElementById('aboutContent').hidden = true;
  document.getElementById('aboutHead').innerHTML = obj.pageTextData[0].title;
  document.getElementById('aboutSub').innerHTML = obj.pageTextData[0].subTitle;
  document.getElementById('aboutText').innerHTML = obj.pageTextData[0].description;
}

getJson();

  </script>
  

  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
      <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
        <svg class="bi" width="30" height="24">
          <use xlink:href="#bootstrap"></use>
        </svg>
      </a>
      <span class="mb-3 mb-md-0 text-body-secondary">2024 Web 3D Assignment</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
      <li class="ms-3 px-3">
        <a class="text-body-secondary" href="https://github.com/Levi-1103/web3D"><img src="./public/images/github.svg" alt="Github" width="32"
            height="32" /></a>
      </li>
    </ul>
  </footer>
</body>

</html>