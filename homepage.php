<?php
include_once 'functions.php';
if (isset($_SESSION['username'])) {
  $username = htmlspecialchars($_SESSION['username']);


  echo "<h2 style='text-align:center;'>Welcome back $username.</h2><br>";
}
?>

<?= template_header("Home | IT FOOD") ?>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/stylesheets.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">F
</head>

<body>
  <br>
  <div class="searchbar">
    <a href="search.php" title="Search Item"><input type="text" placeholder="Search"><i class="fa fa-search" style="background-color:#c09668;border-radius:20px;font-size:19pt;margin-left:-45px;padding:7px;color:white;"></i></a>
    <a href="filter.php" title="Search by Filter" class="fa fa-filter" style="margin:7px;color:#c09668;"></a>
  </div>

  <div class="cuisine-row">
    <div class="row-title">cuisine</div>
    <br>
    <div class="cuisine-container">
      <div class="cuisine-row1">
        <div class="cuisine-column row1">
          <h2>Column 1</h2>
        </div>
        <div class="cuisine-column row1">
          <h2>Column 2</h2>
        </div>
        <div class="cuisine-column row1">
          <h2>Column 3</h2>
        </div>
      </div>

      <div class="cuisine-row1">
        <div class="cuisine-column row2">
          <h2>Column 1</h2>
        </div>
        <div class="cuisine-column row2">
          <h2>Column 2</h2>
        </div>
        <div class="cuisine-column row2">
          <h2>Column 3</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="cuisine-row">
    <div class="row-title">popular <br>
      <a href="allStores.php" style="font-style:aloe;float:right;font-size:14pt;color:black">See All > </a>
    </div>
    <br>
    <div class="popular-container">
      <div class="popular-row1">
        <div class="popular-column">
          <img src="images/icon.jpg" style="width:100%;height:200px;margin-bottom:30px;">
          <div class="about-store">Thai Tom Yam</div>
          <div class="specific">$, Halal, Chicken </div>
        </div>
        <div class="popular-column">
          <h2>Column 2</h2>
        </div>
        <div class="popular-column">
          <h2>Column 3</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="cuisine-row">
    <div class="row-title">all stores</div>
    <br>
    <div class="popular-container">
      <div class="popular-row1">
        <div class="popular-column">
          <img src="images/icon.jpg" style="width:100%;height:200px;margin-bottom:30px;">
          <div class="about-store">Thai Tom Yam</div>
          <div class="specific">$, Halal, Chicken </div>
        </div>
        <div class="popular-column">
          <h2>Column 2</h2>
        </div>
        <div class="popular-column">
          <h2>Column 3</h2>
        </div>
      </div>

      <div class="popular-row1">
        <div class="popular-column">
          <img src="images/icon.jpg" style="width:100%;height:200px;margin-bottom:30px;">
          <div class="about-store">Thai Tom Yam</div>
          <div class="specific">$, Halal, Chicken </div>
        </div>
        <div class="popular-column">
          <h2>Column 2</h2>
        </div>
        <div class="popular-column">
          <h2>Column 3</h2>
        </div>
      </div>
    </div>
  </div>

  <?= template_footer() ?>
</body>

</html>