<?php
$connection = new mysqli("localhost", "root", "", "socialbook");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if ($connection->query($query)) {
        echo "تم التسجيل بنجاح!";
    } else {
        echo "حدث خطأ: " . $connection->error;
    }
}
?>

<form method="POST">
    <label>اسم المستخدم:</label>
    <input type="text" name="username" required><br>
    <label>البريد الإلكتروني:</label>
    <input type="email" name="email" required><br>
    <label>كلمة المرور:</label>
    <input type="password" name="password" required><br>
    <button type="submit">تسجيل</button>
</form>
