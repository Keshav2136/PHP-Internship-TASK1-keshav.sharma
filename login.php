<?php

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dbHost = $_ENV['DB_HOST'];
$dbUsername = $_ENV['DB_USERNAME'];
$dbPassword = $_ENV['DB_PASSWORD'];
$dbDatabase = $_ENV['DB_DATABASE'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>User Login</title>
</head>
<body>
  <h2>User Login</h2>
  <?php
  // Check if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate form data (add your own validation rules)
    if (empty($email) || empty($password)) {
      echo "Please fill in all fields.";
    } else {
      // Connect to MySQL server
      $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbDatabase);

      // Check connection
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }

      // Check if the user exists in the database
      $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
      $result = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($result);

      if ($count == 1) {
        echo "Login successful!";
      } else {
        echo "Invalid login credentials.";
      }

      // Close database connection
      mysqli_close($conn);
    }
  }
  ?>
  <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="email">Email:</label>
    <input type="email" name="email" required><br><br>
    <label for="password">Password:</label>
    <input type="password" name="password" required><br><br>
    <input type="submit" value="Login">
  </form>
</body>
</html>