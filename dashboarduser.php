<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clearart";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
$sql = "SELECT id, FullName, img, Email, Phone, Password FROM user2";
$result = $conn->query($sql);

$users = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
} 
session_start();

if (isset($_SESSION['FullName'])) {
    $FullName = $_SESSION['FullName'];
} else {
    $FullName = "Guest"; 
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="dash.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-success-subtle">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#"><i class="bi bi-person me-3"></i><?php echo htmlspecialchars($FullName); ?></p></a>
                        <button class="btn btn-outline-dark rounded-pill new" type="button" id="openModalBtn5">
                            <i class="bi bi-plus-lg"></i> New User
                        </button>
                    </div>
                </nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-md-4 col-sm-12 mt-3">
            <div class="cc">
                <div class="text-center">
                    <img src="./img/Group 89.jpg" alt="Profile Image" class="img-fluid rounded mb-3 mt-4">
                    <hr class="bg-white mt-4">
                    <p class="text-uppercase fw-bold" style="color: #ACCED3;">Hello <?php echo htmlspecialchars($FullName); ?></p>
                    <hr class="bg-white">
                    <ul class="mt-5 list-unstyled">
                        <li class="u1">
                            <a href="dashboarduser.php" class="u1 mb-2"><i class="bi bi-person me-3"></i><span>Client</span></a>
                        </li>
                        <li class="u1">
                            <a href="item.php" class="u1"><i class="bi bi-file-earmark me-3"></i><span>Items</span></a>
                        </li>
                    </ul>
                    <hr class="bg-white mt-5">
                    <div class="text-center mt-5">
                        <div class="row">
                            
                           
                                <a href="login.html" class="lam"><i class="bi bi-box-arrow-left me-2"></i> <span>Log Out</span></a>
                          
                        </div>
                    </div>
                </div>
            </div>            
        </div>
       
        <div class="col-lg-8 col-md-8 col-sm-12 mt-0">
            <div class="content">
            
                <div class="container">
                    <div class="row">
                        <?php foreach($users as $user): ?>
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                <div class="card-custom text-center p-3">
                                    <img src="data:image/JBG;base64,<?php echo htmlspecialchars($user['img']); ?>" alt="User Image" class="img-fluid rounded-circle mb-3">
                                    <h5><?php echo htmlspecialchars($user['FullName']); ?></h5>
                                    <p class="date"><?php echo date("d F Y"); ?></p>
                                    <button class="btn btn-sm mb-2 openModalBtn4 " data-id="<?php echo htmlspecialchars($user['id']); ?>">Update information</button>
                                    <a href="delate_user.php?id=<?php echo htmlspecialchars($user['id']); ?>" onclick="return confirm('Are you sure you want to delete this user?');">
                                        <button class="btn btn-sm ">Delete User</button>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Please provide the details of the User.</p>              
            </div>
            <form action="adduser.php" method="post" enctype="multipart/form-data">
                <input type="file" class="mt-2 mb-4 ms-4" name="img"><br>
                <b><label class="mb-2 ms-4 l1">FullName</label></b><br>
                <input type="text" name="FullName" placeholder="FullName" required class="custom-input mt-2 mb-1 ms-4 l2"><br>
                
                <b><label class="mt-2 ms-4 mb-2 l1">Email</label></b><br>
                <input type="email" name="Email" placeholder="User Email" required class="custom-input mt-2 mb-2 ms-4 l2"><br>
                
                <b><label class="mt-2 ms-4 mb-2 l1">PhoneNumber</label></b><br>
                <input type="text" name="Phone" placeholder="User Phone Number" required class="custom-input mt-2 ms-4 mb-2 l2"><br>
                
                <b><label class="mt-2 ms-4 mb-2 l1">Password</label></b><br>
                <input type="password" name="Password" placeholder="User password" required class="custom-input ms-4 mt-2 mb-2 l2"><br>
                
                <input type="submit" class="btn btn-dark add ms-4 mb-4" value="Add">
                <input type="reset" class="btn btn-danger add mb-4" value="Back">
            </form>
            
        </div>
    </div>
</div>


<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Update User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Please provide the details of the User.</p>
                <form action="update_user.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="">
                    <input type="file" class="mt-2 mb-4 ms-4" name="img"><br>
                    <b><label class="mb-2 l1">FullName</label></b><br>
                    <input type="text" name="FullName" placeholder="User Name" required class="custom-input mt-2 mb-1 l2"><br>
                    <b><label class="mt-2 mb-2 l1">Email</label></b><br>
                    <input type="email" name="Email" placeholder="User Email" required class="custom-input mt-2 mb-2 l2"><br>
                    <b><label class="mt-2 mb-2 l1">Phone</label></b><br>
                    <input type="text" name="Phone" placeholder="User Phone Number" required class="custom-input mt-2 mb-2 l2"><br>
                    <b><label class="mt-2 mb-2 l1">Password</label></b><br>
                    <input type="password" name="Password" placeholder="User password" required class="custom-input mt-2 mb-2 l2"><br>
                    <input type="submit" class="btn btn-dark add ms-4 mb-4" value="Update">
                    <input type="reset" class="btn btn-danger add mb-4" value="Back">
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="dash.js"></script> 
<script src="update.js"></script> 
</body>
</html>
