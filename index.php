?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];

        // Secure Cookie
        setcookie("auth", session_id(), [
            'httponly' => true,
            'secure' => true, // requires HTTPS
            'samesite' => 'Strict'
        ]);

        header("Location: dashboard.php");
        exit;
    } else {
        echo "Invalid credentials!";
    }
}
?>

<form method="POST">
    <input type="text" name="username" required placeholder="Username" />
    <input type="password" name="password" required placeholder="Password" />
    <button type="submit">Login</button>
</form>
