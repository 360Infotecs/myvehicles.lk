<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>MyVehicles.lk - Home</title>
<?php
include_once("common/head.php");
?>
</head>
<body>

<!-- Start Switcher -->
<?php
include_once("common/switcher.php");
?>
<!-- /Switcher -->  
        
<!--Header-->
<header>
  <?php
  // Main Header //
  include_once("common/header.php");
  //Main Header End//
  // Navigation //
  
include_once("common/navigation.php");
// Navigation end //
?>
</header>
<!-- /Header --> 

<!-- Banners -->
<?php
include_once("common/banner.php");

// /Banners // 

// Filter-Form //

include_once("common/filterForm.php");

// /Filter-Form // 

// About //

include_once("common/about.php");

// /About // 

// Resent Cat//

include_once("common/resentCats.php");

// /Resent Cat // 

// Fun Facts//

include_once("common/funFacts.php");

// /Fun Facts// 

//Featured Car//

include_once("common/featuredCar.php");

// /Featured Car// 

//Trending Car//

include_once("common/trendingCar.php");

// /Trending Car// 

//Testimonial //

include_once("common/testimonial.php");

// /Testimonial// 

//Blog //

include_once("common/blog.php");

// /Blog// 

//Brands//

include_once("common/populerBrands.php");
?>
<!-- /Brands--> 

<!--Footer -->
<footer>
<?php
//include_once("common/footerTop.php");
include_once("common/footerBottom.php");
?>
</footer>
<!-- /Footer-->

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top-->

<!--Login-Form -->
<?php
include_once("common/login.php");

///Login-Form // 

//Register-Form //

include_once("common/register.php");

///Register-Form // 

//Forgot-password-Form //

include_once("common/forgotPassword.php");

///Forgot-password-Form // 
?>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>
</body>
</html>