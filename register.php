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
  <title>User Registration</title>
</head>
<body>
  <h2>User Registration</h2>
  <?php
  // Check if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate form data (add your own validation rules)
    if (empty($name) || empty($email) || empty($password)) {
      echo "Please fill in all fields.";
    } else {
      // Connect to MySQL server
      $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbDatabase);

      // Check connection
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }

      // Insert user data into the database
      $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
      if (mysqli_query($conn, $sql)) {
        echo "Registration successful!";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }

      // Close database connection
      mysqli_close($conn);
    }
  }
  ?>
  <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="name">Name:</label>
    <input type="text" name="name" required><br><br>
    <label for="email">Email:</label>
    <input type="email" name="email" required><br><br>
    <label for="password">Password:</label>
    <input type="password" name="password" required><br><br>
    <input type="submit" value="Register">
  </form>
</body>
</html>
