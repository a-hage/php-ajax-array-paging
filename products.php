<?php
  /**
   * This is the Products Site
   * 
   */
  if(!isset($_SESSION)){
    session_start();
    $customer = $_SESSION['customer'];
    $kunde = $_SESSION['kundeName'];
  }
  if(!empty($kunde)){
    //echo $kunde;
    $limit = 15;
    $start = 0;
    $page = 1;
    require('products-module.php');
  

  }else{
    header('Location: login.php');
  }

  $session_timeout = 1800; // 1800 Sek./60 Sek. = 30 Minuten
  if(!isset($_SESSION['last_activitate'])){
    $_SESSION['last_activitate'] = time();
  }

  if( (time() - $_SESSION['last_activitate'] ) >= $session_timeout){
    session_unset();
    session_destroy();
  }
  $_SESSION['last_activitate'] = time();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Work%20Sans:400,700" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <style>
      .bg-light {
        font-family: "Work Sans" !important;
      }

      h1, h2, h3, h4, h5, h6 {
        font-family: "Poppins";
      }
      h1{
        font-family: "Poppins";
        font-weight: bold;
      }
      h2, h3{
        color: #012970;
        font-size: 2rem;
        font-family: "Poppins";
        font-weight: bold;
      }
      h4 {
        color: #012970;
        font-size: 1.5rem;
        font-family: "Poppins";
        font-weight: bold;
      }
      h5{
        font-family:"Poppins";
        color: #012970;
      }
      thead tr th {
        font-size:14px;
        background-color: rgba(104,182,191,255) !important;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
        line-height: 2.5rem;
      }
      thead tr.unterhead th{
        background-color: #FFF !important;
      }
      .table tr td {
        font-size:14px;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
        line-height: 2.0rem;
      }
      .logo img{
        max-height: 50px;
        margin-right: 0px;
      }

      .loader {
        transform: rotateZ(45deg);
        perspective: 1000px;
        border-radius: 50%;
        width: 48px;
        height: 48px;
        /*color: #A5B5BF;*/
        color: #263E46;
      }
      .loader:before,.loader:after {
        content: '';
        display: block;
        position: absolute;
        top: 0%;
        left: 50%;
        width: inherit;
        height: inherit;
        border-radius: 50%;
        transform: rotateX(70deg);
        animation: 1s spin linear infinite;
      }
      .loader:after {
        color: #9AAFBA;
        transform: rotateY(70deg);
        animation-delay: .4s;
      }

      @keyframes rotate {
        0% {
          transform: translate(-50%, -50%) rotateZ(0deg);
        }
        100% {
          transform: translate(-50%, -50%) rotateZ(360deg);
        }
      }

      @keyframes rotateccw {
        0% {
          transform: translate(-50%, -50%) rotate(0deg);
        }
        100% {
          transform: translate(-50%, -50%) rotate(-360deg);
        }
      }

      @keyframes spin {
        0%,
        100% {
          box-shadow: .2em 0px 0 0px currentcolor;
        }
        12% {
          box-shadow: .2em .2em 0 0 currentcolor;
        }
        25% {
          box-shadow: 0 .2em 0 0px currentcolor;
        }
        37% {
          box-shadow: -.2em .2em 0 0 currentcolor;
        }
        50% {
          box-shadow: -.2em 0 0 0 currentcolor;
        }
        62% {
          box-shadow: -.2em -.2em 0 0 currentcolor;
        }
        75% {
          box-shadow: 0px -.2em 0 0 currentcolor;
        }
        87% {
          box-shadow: .2em -.2em 0 0 currentcolor;
        }
      }
      .pagination-container-one{
        width: 70%;
        float:left;
      }
      .pagination-container-two{
        width: 30%;
        float:right;
      }

      .pagination-container-one .pagination, .pagination-container-two .pagination{
        margin-bottom: 0px;
      }

      .o-page-link, .m-page-link, .tm-page-link, .y-page-link {
        position: relative;
        display: block;
        padding: var(--bs-pagination-padding-y) var(--bs-pagination-padding-x);
        font-size: var(--bs-pagination-font-size);
        color: var(--bs-pagination-color);
        text-decoration: none;
        background-color: var(--bs-pagination-bg);
        /*border: var(--bs-pagination-border-width) solid var(--bs-pagination-border-color);*/
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
      }
      .disabled{
          pointer-events:none;
          opacity:0.7;
      }
      .page-active{
        pointer-events:none;
      }
    </style>
    
  </head>

  <body class="bg-light">
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

      <div class="d-flex align-items-center justify-content-between">
  		  <a href="index2.html" class="logo d-flex align-items-center">
  			  <img src="assets/logo/logo-color.png" alt="logo">
  			  <span class="d-none d-lg-block"></span>
  		  </a>
  		  <i class="bi bi-list toggle-sidebar-btn"></i>
  		</div><!-- End Logo -->


		<nav class="header-nav ms-auto">
		  <ul class="d-flex align-items-center">
			<li class="nav-item dropdown pe-3">
			  <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
				<img src="assets/img/profile.png" alt="Profile" class="rounded-circle">
				<span class="d-none d-md-block dropdown-toggle ps-2">email@web.de</span>
			  </a><!-- End Profile Iamge Icon -->

			  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
				<li>
				  <a class="dropdown-item d-flex align-items-center" href="#">
					<i class="bi bi-box-arrow-right"></i>
					<span>Sign Out</span>
				  </a>
				</li>

			  </ul><!-- End Profile Dropdown Items -->
			</li><!-- End Profile Nav -->

		  </ul>
		</nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
  
    <aside id="sidebar" class="sidebar">
      <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
          <a class="nav-link collapsed" href="products.php">
            <i class="bi bi-grid"></i>
            <span>Products</span>
          </a>
        </li><!-- End Products Nav -->
      </ul>  
    </aside>
  
    <!-- End Sidebar-->

    <main id="main" class="main">
      <div class="pagetitle">
        <h1>Products</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="products.php">Home</a></li>
            <li class="breadcrumb-item active">Products</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->

      <section class="section products">
        <div class="row">
              <!-- All Products -->
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Products <span class="sub-title">| This Year </span></h5>
                    <div class="row">
                      <div class="text-center">
                        <span class="loader"></span>
                      </div>
                    </div>
                    <div id="productsContent">
                      <?php 
                            /* aufruf der Funktion getProductsTable aus dem products-module.php */
                            echo getProducsTable($kunde);
                      ?>
                    </div>
                  </div>
                </div>
              </div><!-- End All products -->
            </div>
          </div><!-- End Left side columns -->
        </div>
      </section>
      <section id="hidden-forms">
        <form action="filter-products.php" id="allProductsTable" method="POST">
          <input type="hidden" name="function_name" id="function_name" value="allProductsFilter" />
          <input type="hidden" name="products_filter" id="products_filter" value="<?php echo $products_filter;?>" /> 
          <input type="hidden" name="products" id="products" value="'.htmlspecialchars(serialize($products)).'" />
          <input type="hidden" name="per_page" id="per_page" value="<?php echo $per_page;?>" />
          <input type="hidden" name="current_page" id="current_page" value="<?php echo $current_page;?>" />
          <input type="hidden" name="kunde" id="kunde" value="<?php echo $kunde;?>" />
        </form>
	<form action="products-paging.php" id="allPagingTable" method="POST">
          <input type="hidden" name="paging_function_name" id="paging_function_name" value="getAllProducts" />
          <input type="hidden" name="paging_products_filter" id="paging_products_filter" value="<?php echo $products_filter;?>" /> 
          <input type="hidden" name="paging_products" id="paging_products" value="'.htmlspecialchars(serialize($products)).'" />
          <input type="hidden" name="paging_per_page" id="paging_per_page" value="<?php echo $per_page;?>" />
          <input type="hidden" name="paging_current_page" id="paging_current_page" value="<?php echo $current_page;?>" />
          <input type="hidden" name="paging_kunde" id="paging_kunde" value="<?php echo $kunde;?>" />
        </form>
      </section>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
      <div class="copyright">
        &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
      </div>
    </footer><!-- End Footer -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/products-paging.js"></script>
  </body>

</html>
