<!-- CONNECTING THE DATABASE -->
<?php
  include("database.php"); 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="general.css" />
    <link rel="stylesheet" href="account.css" />
  </head>
  <body>
    <main>
      <div class="container">
        <!-- Sign Up Form -->
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" class="signup-form">
          <h3 class="heading-tertiary">Create your account!</h3>

          <label class="label">Name </label>
          <input type="text" name="username" class="form-input" placeholder="Aaditya Raikar" required /><br /><br />

          <label class="label">Email address </label>
          <input type="email" name="email" class="form-input" placeholder="me@example.com" required /><br /><br />

          <label class="label">Password </label>
          <input type="password" name="password" class="form-input" placeholder="********" required /><br /><br />

          <!-- Submit Button -->
          <input type="submit" name="register" value="Sign Up" class="submit-btn" />

          <br />
          <span>Already registered? <a href="index.php">Login here</a></span>
        </form>
      </div>
    </main>
  </body>
</html>

<?php
// Handling form submission for registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitize and hash user input
  $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
  $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Inserting new user into database
  $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";

  try {
    mysqli_query($conn, $sql);
    echo "<script type='text/javascript'>";
    echo "alert('You have registered successfully!');";
    echo "window.location.href = 'index.php';";
    echo "</script>";
  } catch (mysqli_sql_exception) {
    echo "<script type='text/javascript'>";
    echo "alert('An error occurred. Please try again.');";
    echo "</script>";
  }
}
?>

<!-- Closing database connection -->
<?php 
  mysqli_close($conn);
?>
