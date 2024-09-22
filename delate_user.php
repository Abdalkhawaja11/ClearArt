<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clearart"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);

    
    $sql = "DELETE FROM user2 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
   
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $userId);

    
    if ($stmt->execute()) {
        
        header("Location: dashboarduser.php"); 
        exit();
    } else {
       
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
} else {
    
    echo "Invalid request. User ID is missing.";
}

$conn->close();
?>
