<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO students (student_id, name, password)
            VALUES (:student_id, :name, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'student_id' => $student_id,
        'name' => $name,
        'password' => $password
    ]);

    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<body>
<h2>Register</h2>
<form method="post">
    Student ID: <input type="text" name="student_id" required><br><br>
    Name: <input type="text" name="name" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Register</button>
</form>
<a href="login.php">Login</a>
</body>
</html>
