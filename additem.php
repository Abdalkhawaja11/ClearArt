<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clearart";

try {
    // إنشاء الاتصال
    $conn = new mysqli($servername, $username, $password, $dbname);

    // فحص الاتصال
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // التحقق من استقبال القيم من POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $iname = trim($_POST["ItemName"]);
        $price = trim($_POST["ItemPrice"]);

        // التعامل مع رفع الصورة
        if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
            // تحديد مسار حفظ الصورة
            $targetDir = "uploads/";
            
            // التأكد من وجود المجلد، إذا لم يكن موجودًا، يتم إنشاؤه
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            
            $targetFile = $targetDir . basename($_FILES["img"]["name"]);

            // التحقق من نجاح رفع الملف
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile)) {
                // تحويل الصورة إلى Base64 وتخزينها في قاعدة البيانات
                $imgData = base64_encode(file_get_contents($targetFile));

                // تحضير الجملة وإدخال البيانات في قاعدة البيانات مع استخدام العمود الصحيح
                $stmt = $conn->prepare("INSERT INTO items (ItemName, ItemImg, ItemPrice) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $iname, $imgData,  $price );

                // تنفيذ الجملة والتحقق من النجاح
                if ($stmt->execute()) {
                    echo "New record created successfully";
                    session_start();
                    header("Location: item.php");
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }

                // إغلاق البيان
                $stmt->close();
            } else {
                echo "Error: Could not upload the file.";
            }
        } else {
            echo "Error: Please upload a valid image file.";
        }
    } else {
        echo "All fields are required.";
    }
} catch (Exception $e) {
    echo $e->getMessage();
} finally {
    // إغلاق الاتصال
    if ($conn) {
        $conn->close();
    }
}
?>
