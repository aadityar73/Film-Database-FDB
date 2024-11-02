<?php
// Start session to manage user login
session_start();

// Redirect to login if user is not logged in
if (!isset($_SESSION["id"])) {
  echo "<script type='text/javascript'>";
  echo "alert('Please log in first!');";
  echo "window.location.href = 'index.php';";
  echo "</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Film Database (FDB)</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet" />

  <!-- External CSS -->
  <link rel="stylesheet" href="general.css" />
  <link rel="stylesheet" href="home.css" />

  <!-- Ionicons for Icons -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
      
  <!-- Header with Logout Button -->
  <header class="header">
    <div class="container">
      <div class="header-container">
        <h1 class="heading-primary">Explore Your Next Favorite Movie</h1>
        <a href="logout.php" class="logout-btn">Log Out</a>
      </div>
    </div>
  </header>
   
  <main>
    <!-- Search Section -->
    <section>
      <div class="container">
        <div class="search-container">
          <input type="text" placeholder="Search for movies, shows, and more ..." class="search-bar" id="movieName" />
          <button class="search-btn">
            <ion-icon class="feature-icon" name="search-outline"></ion-icon>
          </button>
        </div>
      </div>
    </section>

    <!-- Movie Details Section -->
    <section class="section-movie">
      <div class="container">
        <div class="movie-container">
          <div class="poster">
            <img src="" class="poster-img" alt="Poster" />
          </div>
          <div class="movie-details">
            <h2 class="heading-secondary title"></h2>
            <p class="details genre"></p>
            <p class="details plot"></p>
            <p class="details release-date"></p>
            <p class="details runtime"></p>
            <p class="details director"></p>
            <p class="details writer"></p>
            <p class="details stars"></p>
            <p class="details imdb-rating"></p>
            <p class="details seasons"></p>
          </div>
        </div>
      </div>
    </section>

    <!-- Error Section for Handling Search Errors -->
    <section class="error">
      <div class="container">
        <div class="error-container">
          <p class="error-message details"></p>
        </div>
      </div>
    </section>
  </main>

  <!-- JavaScript -->
  <script src="script.js"></script>
</body>
</html>
