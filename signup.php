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

// التحقق من استقبال القيم من POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // التحقق من أن الحقول ليست فارغة
    if (!empty($_POST["FullName"]) && !empty($_POST["Email"]) && !empty($_POST["Phone"]) && !empty($_POST["Password"])) {
        
        $fname = trim($_POST["FullName"]);
        $email = trim($_POST["Email"]);
        $phone = trim($_POST["Phone"]);
        $password = trim($_POST["Password"]);

        // التحقق من صحة البريد الإلكتروني
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format";
            exit();
        }

        // تشفير كلمة المرور
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // تحضير الجملة وإدخال البيانات
        $stmt = $conn->prepare("INSERT INTO users (FullName, Email, Phone, Password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fname, $email, $phone, $hashed_password);

        // تنفيذ الجملة
        if ($stmt->execute()) {
            echo "New record created successfully";

            // إعادة توجيه المستخدم إلى صفحة تسجيل الدخول
            session_start();
            header("Location: login.html");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // إغلاق البيان والاتصال
        $stmt->close();
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
