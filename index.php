<!-- CONNECTING THE DATABASE -->
<?php
  include("database.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log in</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <!-- CSS -->
    <link rel="stylesheet" href="general.css"  />
    <link rel="stylesheet" href="account.css"  />
  </head>
  <body>
    <main>
      <div class="container">
        <!-- Log in Form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" class="login-form">
          <h3 class="heading-tertiary">Log into your account</h3>

          <label class="label">Email address </label>
          <input
            type="email"
            name="email"
            class="form-input"
            placeholder="me@example.com"
            required
          /><br /><br />
          <label class="label">Password </label>
          <input
            type="password"
            name="password"
            class="form-input"
            placeholder="********"
            required
          /><br /> <br />

          <!-- Submit Button -->
          <input type="submit" name="login" value="Log in" class="submit-btn" />

          <br />
          <span>Don't have an account? <a href="signup.php">Register here</a></span>
        </form>
      </div>
    </main>
  </body>
</html>


<?php
// Handling form submission for log in
  if($_SERVER["REQUEST_METHOD"] == "POST"){
  // Sanitize user input    
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    // Querying the database to check if a user with the given email already exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
      
    if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_assoc($result);

      if(password_verify($password, $row["password"])){

        session_start();
        $_SESSION["id"] = $row["id"];

        header("Location: home.php");
      } else{
          echo"<script type='text/javascript'>";
          echo "alert('Invalid username or password.');";
          echo "</script>";
        }
    } else{
        echo"<script type='text/javascript'>";
        echo "alert('User not found.');";
        echo "</script>";      
      }          
  }
?>

<!-- Closing database connection -->
<?php
  mysqli_close($conn);
?>