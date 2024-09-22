<?php
session_start();

// تحقق مما إذا كان المنتج قد تم إرساله عبر النموذج
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // تأكد من أن السلة موجودة في الجلسة، وإذا لم تكن موجودة، أنشئها
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // إضافة المنتج الجديد إلى السلة
    if (isset($_POST['add_to_cart'])) {
        $price = floatval(preg_replace('/[^0-9.]/', '', $_POST['item_price'])); // تحويل السعر إلى عدد عشري والتأكد من إزالة أي نصوص غير رقمية

        $item = [
            'name' => $_POST['item_name'],
            'price' => $price,
            'img' => $_POST['item_img'],
            'quantity' => 1 // تعيين الكمية الافتراضية إلى 1
        ];

        // أضف المنتج إلى السلة
        $_SESSION['cart'][] = $item;
    }

    // معالجة تحديث الكمية
    if (isset($_POST['update_quantity'])) {
        $index = $_POST['index'];
        if (isset($_SESSION['cart'][$index])) {
            // التأكد من وجود المفتاح 'quantity'
            if (!isset($_SESSION['cart'][$index]['quantity'])) {
                $_SESSION['cart'][$index]['quantity'] = 1; // تعيين الكمية الافتراضية إذا لم تكن موجودة
            }

            if ($_POST['action'] === 'increase') {
                $_SESSION['cart'][$index]['quantity'] += 1;
            } elseif ($_POST['action'] === 'decrease' && $_SESSION['cart'][$index]['quantity'] > 1) {
                $_SESSION['cart'][$index]['quantity'] -= 1;
            }
        }
    }

    // معالجة حذف المنتج من السلة
    if (isset($_POST['remove_item'])) {
        $index = $_POST['index'];
        if (isset($_SESSION['cart'][$index])) {
            unset($_SESSION['cart'][$index]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // إعادة ترتيب المؤشرات بعد الحذف
        }
    }
}

// حساب المجموع الفرعي
$subTotal = 0;
foreach ($_SESSION['cart'] as $cartItem) {
    // تأكد من تحويل السعر والكمية إلى أرقام قبل الحساب
    $price = isset($cartItem['price']) ? floatval($cartItem['price']) : 0;
    $quantity = isset($cartItem['quantity']) ? intval($cartItem['quantity']) : 1;

    // تحقق من أن السعر والكمية هما قيم رقمية قبل الجمع
    if (is_numeric($price) && is_numeric($quantity)) {
        $subTotal += $price * $quantity;
    }
}

// قيمة التوصيل الثابتة
$deliveryFee = 20.00; 

// حساب المجموع الكلي
$total = $subTotal + $deliveryFee;
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
        <div class="col-md-6 mt-5">
            <h4>Shopping Cart</h4>
            <hr>
            <?php if (!empty($_SESSION['cart'])): ?>
                <?php foreach ($_SESSION['cart'] as $index => $cartItem): ?>
                    <div class="row align-items-center">
                        <div class="col-6">
                            <img src="data:image/png;base64,<?php echo $cartItem['img']; ?>" class="img-fluid" alt="Product Image">
                        </div>
                        <div class="col-6">
                            <p><b><?php echo htmlspecialchars($cartItem['name']); ?></b></p>
                            <p>Price : <?php echo number_format(floatval($cartItem['price']), 2); ?> SAR</p>
                            <p>Total Price : <?php echo number_format($cartItem['price'] * $cartItem['quantity'], 2); ?> SAR</p>
                            <div class="sar d-flex justify-content-between align-items-center">
                               
                                <form action="cart.php" method="post" style="display:inline;">
                                    <input type="hidden" name="index" value="<?php echo $index; ?>">
                                    <input type="hidden" name="action" value="increase">
                                    <button class="quantity-btn plus-btn" type="submit" name="update_quantity">+</button>
                                </form>
                                <?php echo $cartItem['quantity']; ?>
                                <form action="cart.php" method="post" style="display:inline;">
                                    <input type="hidden" name="index" value="<?php echo $index; ?>">
                                    <input type="hidden" name="action" value="decrease">
                                    <button class="quantity-btn minus-btn" type="submit" name="update_quantity">-</button>
                                </form>

                                
                                <form action="cart.php" method="post" style="display:inline;">
                                    <input type="hidden" name="index" value="<?php echo $index; ?>">
                                    <button class="btn  btn-sm" type="submit" name="remove_item"><i class="fas fa-trash"></i></button> 
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Your shopping cart is empty</p>
            <?php endif; ?>
        </div>

       
        <div class="col-md-6 mt-5">
            <h4>Order Summary</h4>
            <hr>
            <div class="row">
                <div class="col-6">
                    <p>Sub Total</p>
                    <p>Delivery</p>
                    <hr>
                    <h5>Total</h5>
                    <p>Total Points Earned</p>
                </div>
                <div class="col-6 text-end">
                    <p><?php echo number_format($subTotal, 2); ?> SAR</p>
                    <p><?php echo number_format($deliveryFee, 2); ?> SAR</p>
                    <hr>
                    <h5><?php echo number_format($total, 2); ?> SAR</h5>
                    <p><?php echo intval($subTotal * 10); // حساب النقاط المكتسبة كنسبة من المجموع الفرعي ?></p>
                </div>
            </div>
            <button class="btn-sub w-75 ms-5">Submit Order</button>
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
      <script src="del.js"></script>
</body>
</html>