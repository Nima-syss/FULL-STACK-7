<?php
require 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // 1️⃣ Check if student_id already exists
    $checkSql = "SELECT student_id FROM students WHERE student_id = :student_id";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->execute(['student_id' => $student_id]);

    if ($checkStmt->rowCount() > 0) {
        $error = "Student ID already registered!";
    } else {
        // 2️⃣ Insert new student
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
}
?>

<!DOCTYPE html>
<html>
<body>
<h2>Register</h2>

<?php if ($error): ?>
<p style="color:red"><?= $error ?></p>
<?php endif; ?>

<form method="post">
    Student ID: <input type="text" name="student_id" required><br><br>
    Name: <input type="text" name="name" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Register</button>
</form>

<a href="login.php">Login</a>
</body>
</html>
