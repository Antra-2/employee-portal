<?php
session_start();
require_once "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare(
        "SELECT username, password, department FROM users WHERE username = ?"
    );

    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && $password === $user["password"]) {
        $_SESSION["username"] = $user["username"];
        $_SESSION["department"] = $user["department"];

        echo "<h2>Login Successful</h2>";
        echo "<p>Welcome, " . htmlspecialchars($user["username"]) . "</p>";
        echo "<p>Department: " . htmlspecialchars($user["department"]) . "</p>";
    } else {
        $message = "Invalid username or password";
    }
}
?>

<h1>Employee Portal</h1>

<form method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<p><?php echo htmlspecialchars($message); ?></p>
