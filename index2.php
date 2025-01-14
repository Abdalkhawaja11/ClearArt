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
  while ($row = $result->fetch_assoc()) {
    $items[] = $row;
  }
} else {
  echo "No items found";
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
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,260,260i,600,600i,700,700i|Poppins:300,300i,400,400i,260,260i,600,600i,700,700i"
    rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
  <nav class="navbar navbar-expand-lg bg-white sticky-top" id="di">
    <div class="container">
      <a class="navbar-brand" href="index2.php"><img src="./img/Group 89.jpg" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
            <a href="dashboard.html" class="text-dark"><button class="rounded-circle dd"><i
                  class="bi bi-person"></i></a>
          </li>


        </ul>

      </div>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col-md-4 tex">
        <h4 class="fw-bold fs-1 text-center text-md-start">We are eager to make your smile shine like the sun</h4>
        <p class="fs-6 welcome text-center text-md-start">Welcome to Clear Art, where precision meets innovation. With
          years of experience and a commitment to excellence.</p>
        <button class="mt-3 learn d-block mx-auto mx-md-0">Learn More</button>
      </div>
      <div class="col-md-8 imm">
        <div class="col-md-6">
          <img src="./img/smile.jpg" alt="" class="sm">
        </div>
        <div class="col-md-6">
          <img src="./img/dent1.jpeg" alt="" class="de">
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <img src="./img/d193525696f395c08e3d53a341aeee6e.png" alt="" class="img2">
      </div>
      <div class="col-md-6 rrr">
        <h4 class="about fw-bold fs-1">About Clear Art</h4>
        <p class="pp">We provide top-tier dental restorations that ensure patient satisfaction and enhance dental
          practices. Our state-of-the-art technology, combined with the expertise of our skilled technicians, allows us
          to deliver exceptional results, from crowns and bridges to custom prosthetics.</p>
        <ul class="ull">
          <li><img src="./img/Path 32572.png" alt=""> Lorem ipsum dolor sit amet, consectetur adipiscing elit. </li>
          <li><img src="./img/Path 32572.png" alt=""> Fusce malesuada ante et metus imperdiet blandit. </li>
          <li><img src="./img/Path 32572.png" alt=""> Nulla vitae metus tempor, ultricies tortor eu, mattis velit.</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="big-image-container">
          <div class="feature-box">
            <img src="./img/Group 4617.png" alt="Icon 1">
            <h4>Efficient Ordering Process</h4>
            <p>Simplify your workflow with our easy-to-use online ordering system, designed to save you time and ensure
              accuracy with every order.</p>
          </div>
          <div class="d-flex" style="height: 150px;">
            <div class="vr"></div>
          </div>
          <div class="feature-box">
            <img src="./img/Group 4619.png" alt="Icon 2">
            <h4>Real-Time Updates</h4>
            <p>Stay informed with real-time tracking of your orders and instant notifications on the status of your
              dental lab cases, ensuring transparency and peace of mind.</p>
          </div>
          <div class="d-flex" style="height: 150px;">
            <div class="vr"></div>
          </div>
          <div class="feature-box">
            <img src="./img/Group 4615.png" alt="Icon 3">
            <h4>Expert Support</h4>
            <p>Benefit from our dedicated customer support team, available to assist you with any questions or concerns,
              ensuring you receive the highest level of service and satisfaction.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <h4 class="rel mb-5">Featured <span class="fw-bold fs-3">Products</span> </h4>

      <?php foreach ($items as $item): ?>
        <div class="col-md-3 mb-4">
          <div class="card" style="width: 18rem;">

            <a href="det.html"><img src="data:image/png;base64,<?php echo ($item['ItemImg']); ?>"></a>
            <div class="card-body">
              <p class="card-text"><?php echo htmlspecialchars($item['ItemName']); ?></p>
              <div class="d-flex justify-content-between align-items-center">
                <p class="mb-0"><?php echo htmlspecialchars($item['ItemPrice']); ?></p>
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
                  <button type="submit" class="rounded-pill plus">
                    <i class="bi bi-plus-circle"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>

    <a href="Shop.php"><button class="View">View All</button></a>
  </div>

  <div class="container">
    <div class="row ">
      <h4 class="rel">Related <span class="fw-bold fs-3">Links</span> </h4>
      <div class="col-md-6">
        <img src="./img/84559e07f0020d07109552dbd3ae8ae9.png" alt="" class="img3">
      </div>
      <div class="col-md-6 ">
        <h4 class="fw-bold fs-2 rr3">Terumo Dental injection needles 30G - 0.3 x 21mm</h4>
        <p class="pp2">We provide top-tier dental restorations that ensure patient satisfaction and enhance dental
          practices. Our state-of-the-art technology, combined with the expertise of our skilled technicians, allows us
          to deliver exceptional results, from crowns and bridges to custom prosthetics.</p>

        <button class="open ms-2">Open Link</button>

      </div>
    </div>
  </div>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6 ok">
        <img src="./img/84559e07f0020d07109552dbd3ae8ae9.png" alt="" class="img4">
      </div>
      <div class="col-md-6 ol">
        <div class="ll">
          <p class="p1 ">STAY IN TOUCH WITH</p>
          <h2 class="h2">The Only Right Place</h2>
          <button class="contactus">Contact Us</button>
        </div>
      </div>
    </div>
  </div>
  <footer class="mt-5 ff">
    <div class="row">
      <div class="col-md-3">
        <img src="./img/Group 89.jpg" alt="" class="mt-5  ms-5">
        <p class="pp2 ms-5">At Clear Art, we are dedicated to supporting dentists with unparalleled quality,
          reliability, and personalized service. Join us in creating healthier, brighter smiles for all.</p>
      </div>
      <div class="col-md-3">
        <ul class="uu">
          <h4 class="text-white">Site Map</h4>
          <li class="mb-2 lq">Home</li>
          <li class="mb-2 lq">About</li>
          <li class="mb-2 lq">Shop</li>
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
      <p class="copy ms-5">Copy right 2024 &copy; all rights reserved<a href="https://hudhudit.com/web.php"
          class="hud">HUDHUD IT</a></p>
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