<?php
session_start();
require 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM students WHERE student_id = :student_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['student_id' => $student_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['logged_in'] = true;
        $_SESSION['name'] = $user['name'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid login credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<body>
<h2>Login</h2>

<?php if ($error): ?>
<p style="color:red"><?= $error ?></p>
<?php endif; ?>

<form method="post">
    Student ID: <input type="text" name="student_id" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>
<a href="register.php">Register</a>
</body>
</html>
