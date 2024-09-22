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
    $uname = trim($_POST["FullName"]);
    $email = trim($_POST["Email"]);
    $phone = trim($_POST["Phone"]);
    $password = trim($_POST["Password"]);


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["img"]["name"]);

       
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if ($check !== false && in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile);
            $imgData = base64_encode(file_get_contents($targetFile));
        } else {
            die("File is not an image.");
        }

        
        $sql = "UPDATE user2 SET FullName=?, img=?, Email=?, Phone=?, Password=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $uname, $imgData, $phone, $email, $hashed_password, $userId);
    } else {
        // SQL statement without image
        $sql = "UPDATE user2 SET FullName=?, Email=?, Phone=?, Password=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $uname,  $email, $phone , $hashed_password, $userId);
    }

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        header("Location: dashboarduser.php"); // Redirect to the dashboard
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
