<?php
session_start();
$connection = new mysqli("localhost", "root", "", "socialbook");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];
    $query = "INSERT INTO posts (user_id, content) VALUES ('$user_id', '$content')";
    $connection->query($query);
}

$posts = $connection->query("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC");
?>

<h1>مرحبًا بك في Socialbook!</h1>
<form method="POST">
    <textarea name="content" placeholder="ما الذي يجول في خاطرك؟" required></textarea><br>
    <button type="submit">نشر</button>
</form>

<h2>المنشورات</h2>
<?php while ($post = $posts->fetch_assoc()) { ?>
    <div>
        <strong><?php echo $post['username']; ?>:</strong>
        <p><?php echo $post['content']; ?></p>
        <small><?php echo $post['created_at']; ?></small>
    </div>
<?php } ?>
