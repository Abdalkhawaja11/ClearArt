<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clearart";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['id'];
    $iname = trim($_POST["ItemName"]);
    $price = trim($_POST["ItemPrice"]);

    // التعامل مع رفع الصورة
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["img"]["name"]);

        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if ($check !== false && in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            // رفع الملف إلى المسار المحدد
            move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile);
            // تحويل الصورة إلى Base64 لتخزينها في قاعدة البيانات
            $imgData = base64_encode(file_get_contents($targetFile));
        } else {
            die("File is not an image.");
        }

        // تحديث السجل في قاعدة البيانات باستخدام الصورة
        $sql = "UPDATE items SET ItemName=?, ItemImg=?, ItemPrice=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $iname, $imgData, $price, $userId);
    } else {
        // تحديث السجل في قاعدة البيانات بدون تغيير الصورة
        $sql = "UPDATE items SET ItemName=?, ItemPrice=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $iname, $price, $userId);
    }

    // تنفيذ الجملة والتحقق من النجاح
    if ($stmt->execute()) {
        header("Location: item.php"); 
        exit();
    } else {
        echo "Error updating record: " . $stmt->error; // عرض خطأ SQL إذا حدث
    }

    $stmt->close();
    $conn->close();
}
?>
