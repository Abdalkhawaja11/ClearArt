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

// التحقق من طريقة الطلب
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['user_id']; // استرجاع معرف المستخدم
    $fullname = trim($_POST["FullName"]); // استخدم FullName بدلاً من Username
    $phone = trim($_POST["Phone"]);
    $email = trim($_POST["Email"]); // استخدم Email بدلاً من DashboardUsername
    $password = trim($_POST["Password"]); // استخدم Password بدلاً من DashboardPassword

    // تشفير كلمة المرور
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // إذا تم رفع صورة جديدة
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $targetDir = "uploads/";

        // التأكد من وجود المجلد، إذا لم يكن موجودًا، يتم إنشاؤه
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $targetFile = $targetDir . basename($_FILES["img"]["name"]);

        // التحقق من نجاح رفع الملف
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile)) {
            $imgData = base64_encode(file_get_contents($targetFile));

            // تحديث البيانات مع الصورة
            $sql = "UPDATE user2 SET FullName=?, img=?, Phone=?, Email=?, Password=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssi", $fullname, $imgData, $phone, $email, $hashed_password, $userId);
        } else {
            echo "Error: Could not upload the file.";
            exit();
        }
    } else {
        // تحديث البيانات بدون تغيير الصورة
        $sql = "UPDATE user2 SET FullName=?, Phone=?, Email=?, Password=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $fullname, $phone, $email, $hashed_password, $userId);
    }

    // تنفيذ الجملة والتحقق من النجاح
    if ($stmt->execute()) {
        echo "User updated successfully";
        header("Location: dashbord.php"); // إعادة التوجيه إلى صفحة العرض
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // إغلاق البيان والاتصال
    $stmt->close();
    $conn->close();
}
?>
