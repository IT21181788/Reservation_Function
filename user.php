 <?php
 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpmyadmin";

 
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

 
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
 
    try {
        $stmt->execute();
        echo "User added successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>


<html>
<head>
  <title>Your Website</title>

  <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
  <header>
    <h2>Travel Mate</h2>
  </header>
  
 
  <head>

    <title>Add User</title>
  
</head>
<body>
    <h2>Add User</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
 
  
</body>
</html>
