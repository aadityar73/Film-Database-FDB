<?php
  include("database.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log in</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="account.css"  />
  </head>
  <body>
    <div class="container">
      <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" class="login-form">
        <h3 class="heading-tertiary">Log into your account</h3>

        <label class="label">Email address </label>
        <input
          type="email"
          name="email"
          class="form-input"
          placeholder="me@example.com"
        />
        <br /><br />
        <label class="label">Password </label>
        <input
          type="password"
          name="password"
          class="form-input"
          placeholder="********"
        />
        <br /><br />
        <input type="submit" name="login" value="Log in" class="btn" />
        <br>
        <span>Don't have an account? <a href="signup.php">Register here</a></span>
      </form>

      <span
      >
    </div>
  </body>
</html>


<?php

  $_SESSION["userIsLoggedIn"] = false;


  if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if(empty($email) || empty($password)){
      echo"<script type='text/javascript'>";
      echo "alert('Please fill all the fields!');";
      echo "</script>";    
    }
    else{
      $sql = "SELECT * FROM users WHERE email = '$email'";
      $result = mysqli_query($conn, $sql);
      
      if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);

        if(password_verify($password, $row["password"])){
          header("Location: home.html");
        } else{
          echo"<script type='text/javascript'>";
          echo "alert('Invalid Username/Password');";
          echo "</script>";
        }
      } else{
        echo"<script type='text/javascript'>";
        echo "alert('User not found!');";
        echo "</script>";      
      }      
    }
  }
?>

<!-- CLOSING THE CONNECTION -->
<?php
  mysqli_close($conn);
?>