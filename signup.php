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

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="account.css" />
  </head>
  <body>
    <div class="container">
      <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" class="signup-form">
        <h3 class="heading-tertiary">Create your account!</h3>

        <label class="label">Name </label>
        <input
          type="text"
          name="username"
          class="form-input"
          placeholder="Aaditya Raikar"
        /><br /><br />

        <label class="label">Email address </label>
        <input
          type="email"
          name="email"
          class="form-input"
          placeholder="me@example.com"
        /><br /><br />

        <label class="label">Password </label>
        <input
          type="password"
          name="password"
          class="form-input"
          placeholder="********"
        /><br /><br />
        <input type="submit" name="register" value="Sign Up" class="btn" />
        <br />
        <span>Already registered? <a href="index.php">Login here</a></span>
      </form>
    </div>
  </body>
</html>


<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);

    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    
    if(empty($username) || empty($password) || empty($email)){
      echo"<script type='text/javascript'>";
      echo "alert('Please fill all the fields!');";
      echo "</script>";    }
    else{
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      $sql = "INSERT into users (username, email, password)
              VALUES
              ('$username', '$email', '$hashedPassword')";

      try{
        mysqli_query($conn, $sql);
        echo"<script type='text/javascript'>";
        echo "alert('Registered Sucessfully!');";
        echo "window.location.href = 'index.php';";
        echo "</script>";
        

      } catch(mysqli_sql_exception){
        echo"<script type='text/javascript'>";
        echo "alert('Some ERROR occurred. Please Try again.');";
        echo "</script>";
      }
    }
  }
?>

<!-- CLOSING THE CONNECTION -->
<?php
mysqli_close($conn);
?>