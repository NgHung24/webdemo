<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

  <title>
    Nhóm 4
  </title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="index.php">
          <span>
            
          </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""></span>
        </button>

        <div class="collapse navbar-collapse innerpage_navbar" id="navbarSupportedContent">
          <ul class="navbar-nav  ">
            <li class="nav-item ">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="shop.php">
                Shop
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="contact.php">Contact Us</a>
            </li>
          </ul>
          <div class="user_option">
            <a href="login.php">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span>
                Login
              </span>
            </a>
            
            <a href="#">
              <i class="fa fa-shopping-bag" aria-hidden="true"></i>
            </a>
            
            <form class="form-inline ">
              <button class="btn nav_search-btn" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
              </button>
            </form>
          </div>
        </div>
      </nav>
    </header>
    <!-- end header section -->

  </div>
  <!-- end hero area -->

  <!-- cart section -->
<section class="contact_section layout_padding">
<div class="container px-0">

    <?php
    session_start();

    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
?>

        <table class='table table-striped'>
            <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Giá(vnđ)</th>
                <th>Số lượng</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

<?php
            $total = 0;
            foreach ($_SESSION['cart'] as $key => $item) {
                $id = $item['id'];
                $name = $item['name'];
                $price = $item['price'];
                $quantity = $item['quantity'];
?>

                <tr>
                    <td><img src="<?php echo $id; ?>" alt="" width="180" height="180px"></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $price; ?></td>
                    <td>
                        <form method='post'>
                            <input class='quantity-input' type='number' name='new_quantity[]' value='<?php echo $quantity; ?>' min='1'>
                            <input type='hidden' name='product_id[]' value='<?php echo $id; ?>'>
                    </td>
                    <td>
                        <button type='submit' name='delete_product' value='<?php echo $id; ?>' onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">XÓA</button>
                    </td>
                </tr>
<?php

                $subtotal = $price * $quantity;
                $total += $subtotal;
            }
?>
            </tbody>
        </table>
<?php
        echo "<p><div class='alert alert-success'>Tổng giá trị <b>" . count($_SESSION['cart']) . "</b> loại sản phẩm: $total vnđ</div></p>";
?>

    <div class="row"> 
        <div class="col-sm-6"><button type='submit' name='update_quantity_all' onclick="return confirm('Bạn có chắc chắn muốn cập nhật giỏ hàng không ?');">Cập nhật giỏ hàng</button></div>
        <div class="col-sm-6" align="right"><a href="#" class="btn btn-success"  onclick="return confirm('Bạn có chắc chắn muốn mua sản phẩm không?')   "> Mua </a></div>
    </div>
</form>
<?php
    }
     else 
    {
        echo "<h4 style = 'color: red'>GIỎ HÀNG TRỐNG</h4>";
    }

    if (isset($_POST['update_quantity_all'])) {
        $product_ids = $_POST['product_id'];
        $new_quantities = $_POST['new_quantity'];

        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            foreach ($_SESSION['cart'] as &$item) {
                $index = array_search($item['id'], $product_ids);
                if ($index !== false) {
                    $new_quantity = $new_quantities[$index];
                    $item['quantity'] = $new_quantity;
                }
            }
        }
        //exit();
        if ($new_quantity) {
          echo "<script>window.location.href = 'cart.php';</script>";
          exit;
      } else {
          echo "<script>alert('Cập nhật thông tin thất bại.')</script>";
      }
    }

    if (isset($_POST['delete_product'])) 
    {
        $product_id = $_POST['delete_product'];
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['id'] === $product_id) {
                    unset($_SESSION['cart'][$key]);
                    break;
                }
            }
        }
        //exit();
        if ($product_id) {
          echo "<script>window.location.href = 'cart.php';</script>";
          exit;
      } else {
          echo "<script>alert('Cập nhật thông tin thất bại.')</script>";
      }
    } 
?>
</div>
</section>
  <!-- end cart section -->

  <!-- info section -->

  <section class="info_section  layout_padding2-top">
    <div class="social_container">
      <div class="social_box">
      <a href="https://www.facebook.com/pahahtahh" target="_blank">
          <i class="fa fa-facebook" aria-hidden="true"></i>
        </a>
        <a href="https://twitter.com/pahahtahh_" target = "_blank">
          <i class="fa fa-twitter" aria-hidden="true"></i>
        </a>
        <a href="https://www.instagram.com/pahntan_/" target = "_blank">
          <i class="fa fa-instagram" aria-hidden="true"></i>
        </a>
      </div>
    </div>
    <div class="info_container ">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3">
            <h6>
              ABOUT US
            </h6>
            <div class="info_link-box">
              <a href="">
                <span> Introduce Recruitment </span>
              </a>
              <a href="">
                <span> Rules Privacy Policy </span>
              </a>
              <a href="shop.php">
                <span> Flash Sales </span>
              </a>
              <a href="">
                <span> Media Contact </span>
              </a>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="info_form ">
              <h5>
                Newsletter
              </h5>
              <form action="#">
                <input type="email" placeholder="Enter your email">
                <button>
                  Subscribe
                </button>
              </form>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <h6>
              NEED HELP
            </h6>
            <div class="info_link-box">
              <a href="">
                <span> Store </span>
              </a>
              <a href="">
                <span> How to order </span>
              </a>
              <a href="">
                <span> Shipping and Delivery </span>
              </a>
              <a href="">
                <span> Payment Options </span>
              </a>
              <a href="">
                <span> Returns </span>
              </a>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <h6>
              CONTACT US
            </h6>
            <div class="info_link-box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span> Gb road 123 london Uk </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>+84 346064200</span>
              </a>
              <a href="https://mail.google.com/" target="_blank">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span> phananhtan2411@gmail.com</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- footer section -->
    <footer class=" footer_section">
      <div class="container">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="https://html.design/">Phan Anh Tan Coder</a>
        </p>
      </div>
    </footer>
    <!-- footer section -->

  </section>

  <!-- end info section -->


  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <script src="js/custom.js"></script>

</body>

</html>