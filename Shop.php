<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clearart";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT ItemName, ItemImg, ItemPrice FROM items";
$result = $conn->query($sql);


if (!$result) {
    die("Error: " . $conn->error);
}

$items = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
} else {
   
}

session_start(); 

if (isset($_SESSION['FullName'])) {
    $fullname = $_SESSION['FullName'];
} else {
    $fullname = "Guest"; 
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="css/all.min.css">
     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/bootstrap.min.css.map">
     <link rel="stylesheet" href="js/all.min.js">
     <link rel="stylesheet" href="js/bootstrap.bundle.min.js">
     <link rel="stylesheet" href="js/bootstrap.bundle.min.js.map">
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,260,260i,600,600i,700,700i|Poppins:300,300i,400,400i,260,260i,600,600i,700,700i" rel="stylesheet">
   <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
  <nav class="navbar navbar-expand-lg bg-white sticky-top">
    <div class="container">      
      <a class="navbar-brand" href="index2.php"><img src="./img/Group 89.jpg" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><i class="bi bi-justify"></i></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link hh1" aria-current="page" href="index2.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ab" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ab" href="Shop.php">Shop</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link ab" href="#">Contact</a>
          </li>
          <li class="nav-item">
            <button class="rounded-circle dd"><i class="bi bi-search"></i></button>
          </li>
          <li class="nav-item">
            <button class="rounded-circle dd"><i class="bi bi-bell-fill"></i></button>
          </li>
          <li class="nav-item">
            <a href="cart.php"><button class="rounded-circle dd"><i class="bi bi-bag"></i></button></a>
            </button>
          </li>
          <li class="nav-item">
            <a href="fav.php" class="text-dark"><button class="rounded-circle dd"><i class="bi bi-heart-fill"></i></a>
          </li>
          <li class="nav-item">
            <a href="dashboard.html" class="text-dark"><button class="rounded-circle dd"><i class="bi bi-person"></i></a>
          </li>
          

        </ul>
        
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="row">
        <h4 class="rel mb-5">Shop <span class="fw-bold fs-3">Products</span> </h4>
        <?php foreach($items as $item): ?>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <a href="det.html">
                        <img src="data:image/png;base64,<?php echo ($item['ItemImg']); ?>">
                    </a>
                    <div class="card-body">
                        <p class="card-text"><?php echo htmlspecialchars($item['ItemName']); ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-0"><?php echo htmlspecialchars($item['ItemPrice']); ?>  SAR</p>

                            <form action="fav.php" method="post">
    <input type="hidden" name="add_to_fav" value="1">
    <input type="hidden" name="item_name" value="<?php echo htmlspecialchars($item['ItemName']); ?>">
    <input type="hidden" name="item_price" value="<?php echo htmlspecialchars($item['ItemPrice']); ?>">
    <input type="hidden" name="item_img" value="<?php echo htmlspecialchars($item['ItemImg']); ?>">
    <button class="rounded-pill bookmark" type="submit">
        <i class="bi bi-bookmark"></i>
    </button>
</form>

                              
    <form action="cart.php" method="post">
    <input type="hidden" name="add_to_cart" value="1">
    <input type="hidden" name="item_name" value="<?php echo htmlspecialchars($item['ItemName']); ?>">
    <input type="hidden" name="item_price" value="<?php echo htmlspecialchars($item['ItemPrice']); ?>">
    <input type="hidden" name="item_img" value="<?php echo htmlspecialchars($item['ItemImg']); ?>">
    <button type="submit" class="rounded-pill plus ">
        <i class="bi bi-plus-circle"></i>
    </button>
</form>

                            
                        </div>
                    </div>
                </div>        
            </div>
        <?php endforeach; ?>
    </div>
</div>

  <footer class="mt-5 ff">
    <div class="row">
      <div class="col-md-3">
        <img src="./img/Group 89.jpg" alt="" class="mt-5  ms-5">
        <p class="pp2 ms-5">At Clear Art, we are dedicated to supporting dentists with unparalleled quality, reliability, and personalized service. Join us in creating healthier, brighter smiles for all.</p>
      </div>
      <div class="col-md-3">
        <ul class="uu">
          <h4 class="text-white">Site Map</h4>
          <li class="mb-2 lq"><a>Home</a></li>
          <li class="mb-2 lq"><a>About</a></li>
          <li class="mb-2 lq"><a>Shop</a></li>
        </ul>
      </div>
      <div class="col-md-3">
        <ul class="uu">
          <h4 class="text-white">Support</h4>
          <li class="mb-2 lq"><a>Contact</a></li>
          <li class="mb-2 lq"><a>Terms & Conditions</a></li>
          <li class="mb-2 lq"><a>Privacy Policy</a></li>
        </ul>
      </div>
      <div class="col-md-3">
        <ul class="u2">
          <li class="mb-0"><i class="bi bi-geo-alt-fill me-2 loc"></i>5TH circle- Karadsheh</li>
            <li class="mb-2 ms-4"> Tower - Amman - Jordan</li>
          <li class="mb-2"><i class="bi bi-envelope-fill me-2 loc"></i>contact@clearart.com</li>
          <li class="mb-2"><i class="bi bi-telephone me-2 loc"></i>+962 79 000 0000</li>
          <img src="./img/Group 1215.png" alt="" class="me-4">
          <img src="./img/Group 1214.png" alt="" class="me-4">
          <img src="./img/Group 1213.png" alt="" class="me-4">
          <img src="./img/Group 1212.png" alt="" class="me-4">
        </ul>
      </div>
      <hr class="hr">
      <p class="copy ms-5">Copy right 2024 &copy; all rights reserved<a href="https://hudhudit.com/web.php" class="hud">HUDHUD IT</a></p>
    </div>
  </footer>
  
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src="script.js"></script>
      <script src="del.js"></script>
  </body>
  </html>