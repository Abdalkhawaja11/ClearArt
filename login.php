<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clearart";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// فحص الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// الحصول على معلومات المستخدم من النموذج
$Phone = $_POST["Phone"];
$password = $_POST["Password"];

// التحقق من صحة المستخدم من قاعدة البيانات
$stmt = $conn->prepare("SELECT Phone, Password FROM users WHERE Phone = ?");
$stmt->bind_param("s", $Phone);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashed_password = $row["Password"];

    // تحقق من كلمة المرور
    if (password_verify($password, $hashed_password)) {
        // بدء الجلسة وتخزين اسم المستخدم
        session_start();
        $_SESSION['Phone'] = $row['Phone'];
        header("Location: index2.php"); // الانتقال إلى الصفحة الرئيسية
        exit();
    } else {
        echo '<script>alert("Wrong Username or Password"); window.location.href = "login.html";</script>';
    }
} else {
    echo '<script>alert("Wrong Username or Password"); window.location.href = "login.html";</script>';
}

// إغلاق الاتصال
$stmt->close();
$conn->close();
?>
