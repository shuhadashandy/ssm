<?php require_once('Connections/dssm.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO kontak (Nama, Email, Judul, Isi) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['Nama'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Judul'], "text"),
                       GetSQLValueString($_POST['Isi'], "text"));

  mysql_select_db($database_dssm, $dssm);
  $Result1 = mysql_query($insertSQL, $dssm) or die(mysql_error());
}

mysql_select_db($database_dssm, $dssm);
$query_Rtssm = "SELECT * FROM tentang";
$Rtssm = mysql_query($query_Rtssm, $dssm) or die(mysql_error());
$row_Rtssm = mysql_fetch_assoc($Rtssm);
$totalRows_Rtssm = mysql_num_rows($Rtssm);

mysql_select_db($database_dssm, $dssm);
$query_Rtssm1 = "SELECT * FROM tentang WHERE ID = 3";
$Rtssm1 = mysql_query($query_Rtssm1, $dssm) or die(mysql_error());
$row_Rtssm1 = mysql_fetch_assoc($Rtssm1);
$totalRows_Rtssm1 = mysql_num_rows($Rtssm1);

mysql_select_db($database_dssm, $dssm);
$query_Rfkssm = "SELECT * FROM footerkiri";
$Rfkssm = mysql_query($query_Rfkssm, $dssm) or die(mysql_error());
$row_Rfkssm = mysql_fetch_assoc($Rfkssm);
$totalRows_Rfkssm = mysql_num_rows($Rfkssm);

mysql_select_db($database_dssm, $dssm);
$query_Rfkssm1 = "SELECT * FROM footerkanan";
$Rfkssm1 = mysql_query($query_Rfkssm1, $dssm) or die(mysql_error());
$row_Rfkssm1 = mysql_fetch_assoc($Rfkssm1);
$totalRows_Rfkssm1 = mysql_num_rows($Rfkssm1);

$maxRows_Rpssm = 9;
$pageNum_Rpssm = 0;
if (isset($_GET['pageNum_Rpssm'])) {
  $pageNum_Rpssm = $_GET['pageNum_Rpssm'];
}
$startRow_Rpssm = $pageNum_Rpssm * $maxRows_Rpssm;

mysql_select_db($database_dssm, $dssm);
$query_Rpssm = "SELECT * FROM portofolio ORDER BY ID DESC";
$query_limit_Rpssm = sprintf("%s LIMIT %d, %d", $query_Rpssm, $startRow_Rpssm, $maxRows_Rpssm);
$Rpssm = mysql_query($query_limit_Rpssm, $dssm) or die(mysql_error());
$row_Rpssm = mysql_fetch_assoc($Rpssm);

if (isset($_GET['totalRows_Rpssm'])) {
  $totalRows_Rpssm = $_GET['totalRows_Rpssm'];
} else {
  $all_Rpssm = mysql_query($query_Rpssm);
  $totalRows_Rpssm = mysql_num_rows($all_Rpssm);
}
$totalPages_Rpssm = ceil($totalRows_Rpssm/$maxRows_Rpssm)-1;

$maxRows_Rsssm = 10;
$pageNum_Rsssm = 0;
if (isset($_GET['pageNum_Rsssm'])) {
  $pageNum_Rsssm = $_GET['pageNum_Rsssm'];
}
$startRow_Rsssm = $pageNum_Rsssm * $maxRows_Rsssm;

mysql_select_db($database_dssm, $dssm);
$query_Rsssm = "SELECT * FROM layanan ORDER BY ID DESC";
$query_limit_Rsssm = sprintf("%s LIMIT %d, %d", $query_Rsssm, $startRow_Rsssm, $maxRows_Rsssm);
$Rsssm = mysql_query($query_limit_Rsssm, $dssm) or die(mysql_error());
$row_Rsssm = mysql_fetch_assoc($Rsssm);

if (isset($_GET['totalRows_Rsssm'])) {
  $totalRows_Rsssm = $_GET['totalRows_Rsssm'];
} else {
  $all_Rsssm = mysql_query($query_Rsssm);
  $totalRows_Rsssm = mysql_num_rows($all_Rsssm);
}
$totalPages_Rsssm = ceil($totalRows_Rsssm/$maxRows_Rsssm)-1;

mysql_select_db($database_dssm, $dssm);
$query_Rmssm = "SELECT * FROM motivation";
$Rmssm = mysql_query($query_Rmssm, $dssm) or die(mysql_error());
$row_Rmssm = mysql_fetch_assoc($Rmssm);
$totalRows_Rmssm = mysql_num_rows($Rmssm);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PT. SYAM SURYA MANDIRI</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Gp - v4.7.0
  * Template URL: https://bootstrapmade.com/gp-free-multipurpose-html-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="index.php">PT. SYAM SURYA MANDIRI<span>.</span></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto " href="#portfolio">Portfolio</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="#about" class="get-started-btn scrollto">Get Started</a>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
        <div class="col-xl-6 col-lg-8">
          <h2>PT. Syam Surya Mandiri<span>.</span></h2>
          <h2>We are team with high experience</h2>
        </div>
      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="master/upload/<?php echo $row_Rtssm['Gambar']; ?>" class="img-fluid" alt="">
			</div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">
            <h3><?php echo $row_Rtssm['Judul']; ?>.</h3>
            <p class="fst-italic">
              <?php echo $row_Rtssm['Isi']; ?>
            </p>
            <p>
              
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
      <div class="container" data-aos="zoom-in">
        <div class="clients-slider swiper">
          <div class="swiper-wrapper align-items-center">
          <?php do { ?>            
            <div class="swiper-slide"><img src="master/upload/<?php echo $row_Rsssm['Gambar']; ?>" class="img-fluid" alt=""></div>
          <?php } while ($row_Rsssm = mysql_fetch_assoc($Rsssm)); ?>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section><!-- End Clients Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="image col-lg-6" style='background-image: url("master/upload/<?php echo $row_Rtssm1['Gambar']; ?>");' data-aos="fade-right"></div>
          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
            <div class="icon-box mt-5 mt-lg-0" data-aos="zoom-in" data-aos-delay="150">
              <i class="bx bx-receipt"></i>
              <h3><?php echo $row_Rtssm1['Judul']; ?>.</h3>
              <p><?php echo $row_Rtssm1['Isi']; ?></p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Features Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Product</h2>
          <p>Check our Product</p>
        </div>
        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

          <?php do { ?>
          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="master/upload/<?php echo $row_Rpssm['Gambar']; ?>" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><?php echo $row_Rpssm['Judul']; ?></h4>
                <p><?php echo $row_Rpssm['Judul']; ?></p>
                <div class="portfolio-links">
                  <a href="master/upload/<?php echo $row_Rpssm['Gambar']; ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?php echo $row_Rpssm['Judul']; ?>"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.php" target="_blank" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>
            <?php } while ($row_Rpssm = mysql_fetch_assoc($Rpssm)); ?>
      </div>
    </section><!-- End Portfolio Section -->
    
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
          <p>Contact Us</p>
        </div>

          <div class="col-lg-8 mt-5 mt-lg-0">
            <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
              <table align="left">
                <tr valign="baseline">
                  <td nowrap align="right"></td>
                  <td><input type="text" name="Nama" value="" size="75" placeholder="Your Name"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right"></td>
                  <td><input type="text" name="Email" value="" size="75" placeholder="E-Mail"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right"></td>
                  <td><input type="text" name="Judul" value="" size="75" placeholder="Subject"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right"></td>
                  <td><textarea name="Isi" cols="75" rows="5" placeholder="Messages"></textarea></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right">&nbsp;</td>
                  <td><input type="submit" value="Send"></td>
                </tr>
              </table>
              <input type="hidden" name="MM_insert" value="form1">
            </form>
            <p>&nbsp;</p>
          </div>
      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h4><span><?php echo $row_Rfkssm['Judul']; ?>.</span></h4>
              <p>
                <?php echo $row_Rfkssm['Isi']; ?> <br>
                <?php echo $row_Rfkssm['Isi2']; ?><br><br>
                <strong>Phone:</strong> <?php echo $row_Rfkssm['Phone']; ?><br>
                <strong>Email:</strong> <?php echo $row_Rfkssm['Email']; ?><br>
              </p>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            

          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            

          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>PT. SYAM SURYA MANDIRI</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/gp-free-multipurpose-html-bootstrap-template/
        Designed by <a href="https://bootstrapmade.com/">Developer PT. Syam Surya Mandiri</a>
      </div>
    </div>
  </footer><!-- End Footer

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
<?php
mysql_free_result($Rtssm);
mysql_free_result($Rtssm1);
mysql_free_result($Rfkssm);
mysql_free_result($Rfkssm1);
mysql_free_result($Rpssm);
mysql_free_result($Rsssm);

mysql_free_result($Rmssm);
?>