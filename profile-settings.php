<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>MyVehicles.lk - Profile Settings</title>
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

<!--Page Header-->
<!--<section class="page-header profile_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Your Profile</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li>Profile</li>
      </ul>
    </div>
  </div>-->
  <!-- Dark Overlay-->
  <!--<div class="dark-overlay"></div>
</section>-->
<!-- /Page Header--> 

<!--Profile-setting-->
<section class="user_profile inner_pages">
  <div class="container">
    <div class="user_profile_info gray-bg padding_4x4_40">
      <div class="upload_user_logo"> <img src="assets/images/dealer-logo.jpg" alt="image">
        <div class="upload_newlogo">
          <input name="upload" type="file">
        </div>
      </div>
      <div class="dealer_info">
        <h5>Autospot Used Cars Center </h5>
        <p>P.1225 N Broadway Ave <br>
          Oklahoma City, OK  1234-5678-090</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 col-sm-3">
        <div class="profile_nav">
          <ul>
            <li class="active"><a href="profile-settings.php">Profile Settings</a></li>
            <li><a href="my-vehicles.php">My Vehicles</a></li>
            <li><a href="post-vehicle.php">Post a Vehicles</a></li>
            <li><a href="#">Sign Out</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-6 col-sm-8">
		<form action="#" method="get">
			<div class="profile_wrap">
			  <h5 class="uppercase underline">Genral Settings</h5>
				<div class="form-group">
				  <label class="control-label">Full Name</label>
				  <input class="form-control white_bg" id="fullname" type="text">
				</div>
				<div class="form-group">
				  <label class="control-label">Email Address</label>
				  <input class="form-control white_bg" id="email" type="email">
				</div>
				<div class="form-group">
				  <label class="control-label">Phone Number</label>
				  <input class="form-control white_bg" id="phone-number" type="text">
				</div>
				<div class="form-group">
				  <label class="control-label">Date of Birth</label>
				  <input class="form-control white_bg" id="birth-date" type="text">
				</div>
				<div class="form-group">
				  <label class="control-label">Your Address</label>
				  <textarea class="form-control white_bg" rows="4"></textarea>
				</div>
				<div class="form-group">
				  <label class="control-label">Country</label>
				  <input class="form-control white_bg" id="country" type="text">
				</div>
				<div class="form-group">
				  <label class="control-label">City</label>
				  <input class="form-control white_bg" id="city" type="text">
				</div>
			</div>
			<div class="profile_wrap">
				<!--<div class="gray-bg field-title">
				  <h6>Update password</h6>
				</div>-->
				<h5 class="uppercase underline">Update password</h5>
				<div class="form-group">
				  <label class="control-label">Password</label>
				  <input class="form-control white_bg" id="password" type="password">
				</div>
				<div class="form-group">
				  <label class="control-label">Confirm Password</label>
				  <input class="form-control white_bg" id="c-password" type="password">
				</div>
				<div class="gray-bg field-title">
				  <h6>Social Links</h6>
				</div>
				<div class="form-group">
				  <label class="control-label">Facebook ID</label>
				  <input class="form-control white_bg" id="facebook" type="text">
				</div>
				<div class="form-group">
				  <label class="control-label">Twitter ID</label>
				  <input class="form-control white_bg" id="twitter" type="text">
				</div>
				<div class="form-group">
				  <label class="control-label">Linkedin ID</label>
				  <input class="form-control white_bg" id="linkedin" type="text">
				</div>
				<div class="form-group">
				  <label class="control-label">Google+ ID</label>
				  <input class="form-control white_bg" id="google" type="text">
				</div>
				<div class="form-group">
				  <button type="submit" class="btn">Save Changes <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
				</div>
			</div>
		</form>
      </div>
    </div>
  </div>
</section>
<!--/Profile-setting--> 

<!--Brands-->
<?php

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
<!-- Scripts --> 
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