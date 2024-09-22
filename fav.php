<?php
session_start();

// تأكد من وجود قائمة المفضلة في الجلسة، وإذا لم تكن موجودة، أنشئها
if (!isset($_SESSION['favorites'])) {
    $_SESSION['favorites'] = [];
}

// معالجة طلبات POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // إضافة المنتج إلى المفضلة
    if (isset($_POST['add_to_fav'])) {
        $item = [
            'name' => $_POST['item_name'],
            'price' => floatval($_POST['item_price']), // تحويل السعر إلى عدد عشري
            'img' => $_POST['item_img'],
        ];

        // تحقق من عدم إضافة المنتج بالفعل إلى المفضلة
        if (!in_array($item, $_SESSION['favorites'])) {
            $_SESSION['favorites'][] = $item; // أضف المنتج إلى المفضلة
        }

        // إعادة توجيه إلى الصفحة السابقة أو عرض رسالة نجاح
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // حذف المنتج من المفضلة
    if (isset($_POST['remove_item'])) {
        $index = $_POST['index'];
        if (isset($_SESSION['favorites'][$index])) {
            unset($_SESSION['favorites'][$index]);
            $_SESSION['favorites'] = array_values($_SESSION['favorites']); // إعادة ترتيب المؤشرات بعد الحذف
        }

        // إعادة توجيه إلى الصفحة السابقة أو عرض رسالة نجاح
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
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
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-2 person">
        <img src="./img/7A0A0422.jpg" alt="" class=" img-fluied rounded-circle w-50 h-25 mt-5 ms-4">
        <p class="ms-2 mt-3 fw-bold">Abdelrhman Naser</p>
        <div class="info-button">
           <a href="dashboard.html"><i class="bi bi-person"></i> 
           <span>Info</span></a>
       </div>
       <div class="info-button">
           <a href="fav.php"><i class="bi bi-bookmark"></i>
           <span>Favorite</span></a>
       </div>
       <div class="info-button">
           <a href="orders.html"><i class="bi bi-bag"></i>
           <span>Orders</span></a>
       </div>
   </div>
   <div class="col-md-10">
    <div class="row">
        <?php if (!empty($_SESSION['favorites'])): ?>
            <?php foreach ($_SESSION['favorites'] as $index => $favItem): ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <a href="det.html"><img src="data:image/png;base64,<?php echo $favItem['img']; ?>" class="card-img-top" alt="Product Image"></a>
                        <div class="card-body">
                            <p class="card-text"><?php echo htmlspecialchars($favItem['name']); ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="mb-0"><?php echo htmlspecialchars($favItem['price']); ?> SAR</p>
                                <div>
                                    <!-- زر لحذف المنتج من المفضلة -->
                                    <form action="fav.php" method="post" style="display:inline;">
                                        <input type="hidden" name="index" value="<?php echo $index; ?>">
                                        <button class="rounded-pill bookmark btn-sm" type="submit" name="remove_item">
                                            <i class="fas fa-trash"></i>
                                        </button> 
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>        
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>There is no item in your favorites.</p>
        <?php endif; ?>
    </div>
</div>


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