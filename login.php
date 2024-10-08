<?php
session_start();
$connection = new mysqli("localhost", "root", "", "socialbook");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: home.php");
        } else {
            echo "كلمة المرور غير صحيحة!";
        }
    } else {
        echo "المستخدم غير موجود!";
    }
}
?>

<form method="POST">
    <label>البريد الإلكتروني:</label>
    <input type="email" name="email" required><br>
    <label>كلمة المرور:</label>
    <input type="password" name="password" required><br>
    <button type="submit">تسجيل الدخول</button>
</form>
