<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    setcookie('theme', $_POST['theme'], time() + (86400 * 30));
    header("Location: dashboard.php");
    exit;
}

$currentTheme = $_COOKIE['theme'] ?? 'light';
?>

<!DOCTYPE html>
<html>
<body>
<h2>Select Theme</h2>

<form method="post">
    <select name="theme">
        <option value="light" <?= $currentTheme === 'light' ? 'selected' : '' ?>>Light Mode</option>
        <option value="dark" <?= $currentTheme === 'dark' ? 'selected' : '' ?>>Dark Mode</option>
    </select>
    <br><br>
    <button type="submit">Save Preference</button>
</form>

<a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
