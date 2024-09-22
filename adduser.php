<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clearart";

try {
   
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (!empty($_POST["FullName"]) && !empty($_POST["Email"]) && !empty($_POST["Phone"]) && !empty($_POST["Password"])) {

            $fname = trim($_POST["FullName"]);
            $email = trim($_POST["Email"]);
            $phone = trim($_POST["Phone"]);
            $password = trim($_POST["Password"]);

            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Invalid email format";
                exit();
            }

          
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            
            if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
               
                $targetDir = "uploads/";
                
               
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }
                
                $targetFile = $targetDir . basename($_FILES["img"]["name"]);

              
                if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile)) {
               
                    $imgData = base64_encode(file_get_contents($targetFile));
                    $stmt = $conn->prepare("INSERT INTO user2 (FullName, img, Email, Phone, Password) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param("sssss", $fname, $imgData, $email, $phone, $hashed_password);

                   
                    if ($stmt->execute()) {
                        echo "New record created successfully";
                        session_start();
                        header("Location: dashboarduser.php");
                        exit();
                    } else {
                        echo "Error: " . $stmt->error;
                    }

                  
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
    } else {
        throw new Exception("Invalid request.");
    }
} catch (Exception $e) {
    echo $e->getMessage();
} finally {

    if ($conn) {
        $conn->close();
    }
}
?>
