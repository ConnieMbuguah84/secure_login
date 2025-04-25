<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
?>
<h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>! 🎉</h2>
<a href="logout.php">Logout</a>
