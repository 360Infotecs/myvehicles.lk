<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>MyVehicles.lk - Listing Grid</title>
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
<!--<section class="page-header listing_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Car Listing Grid</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li>Car Listing</li>
      </ul>
    </div>
  </div>-->
  <!-- Dark Overlay-->
  <!--<div class="dark-overlay"></div>
</section>-->
<!-- /Page Header--> 

<!--Listing-grid-view-->
<section class="listing-page">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-md-push-3">
        <div class="result-sorting-wrapper">
          <div class="sorting-count">
            <p>1 - 12 <span>of 50 Results for your search.</span></p>
          </div>
          <div class="result-sorting-by">
            <p>Sort by:</p>
            <form action="#" method="post">
              <div class="form-group select sorting-select">
                <select class="form-control ">
                  <option>Price (low to high)</option>
                  <option>Price (high to low)</option>
                  <option>Newest Items</option>
                </select>
              </div>
            </form>
			<p><a href="listing-classic.php">List View</a></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 grid_listing">
            <div class="product-listing-m gray-bg">
              <div class="product-listing-img"> <a href="listing-detail-2.php"><img src="assets/images/featured-img-1.jpg" class="img-responsive" alt="image" /> </a>
                <div class="label_icon">New</div>
                <div class="compare_item">
                  <div class="checkbox">
                    <input type="checkbox" value="" id="compare10">
                    <label for="compare10">Compare</label>
                  </div>
                </div>
              </div>
              <div class="product-listing-content">
                <h5><a href="listing-detail-2.php">Mazda CX-5 SX, V6, ABS, Sunroof </a></h5>
                <p class="list-price">$89,000</p>
                <div class="car-location"><span><i class="fa fa-map-marker" aria-hidden="true"></i> Colorado, USA</span></div>
                <ul class="features_list">
                  <li><i class="fa fa-road" aria-hidden="true"></i>35,000 km</li>
                  <li><i class="fa fa-tachometer" aria-hidden="true"></i>30.000 miles</li>
                  <li><i class="fa fa-calendar" aria-hidden="true"></i>2005 model</li>
                  <li><i class="fa fa-car" aria-hidden="true"></i>Diesel</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid_listing">
            <div class="product-listing-m gray-bg">
              <div class="product-listing-img"> <a href="#"><img src="assets/images/featured-img-2.jpg" class="img-responsive" alt="image" /> </a>
                <div class="label_icon">Used</div>
                <div class="compare_item">
                  <div class="checkbox">
                    <input type="checkbox" value="" id="compare11">
                    <label for="compare11">Compare</label>
                  </div>
                </div>
              </div>
              <div class="product-listing-content">
                <h5><a href="#">Maserati QUATTROPORTE 1,6</a></h5>
                <p class="list-price">$89,000</p>
                <div class="car-location"><span><i class="fa fa-map-marker" aria-hidden="true"></i> Colorado, USA</span></div>
                <ul class="features_list">
                  <li><i class="fa fa-road" aria-hidden="true"></i>35,000 km</li>
                  <li><i class="fa fa-tachometer" aria-hidden="true"></i>30.000 miles</li>
                  <li><i class="fa fa-calendar" aria-hidden="true"></i>2005 model</li>
                  <li><i class="fa fa-car" aria-hidden="true"></i>Diesel</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid_listing">
            <div class="product-listing-m gray-bg">
              <div class="product-listing-img"> <a href="#"><img src="assets/images/featured-img-3.jpg" class="img-responsive" alt="image" /> </a>
                <div class="label_icon">New</div>
                <div class="compare_item">
                  <div class="checkbox">
                    <input type="checkbox" value="" id="compare12">
                    <label for="compare12">Compare</label>
                  </div>
                </div>
              </div>
              <div class="product-listing-content">
                <h5><a href="#">Maserati QUATTROPORTE 1,6</a></h5>
                <p class="list-price">$89,000</p>
                <div class="car-location"><span><i class="fa fa-map-marker" aria-hidden="true"></i> Colorado, USA</span></div>
                <ul class="features_list">
                  <li><i class="fa fa-road" aria-hidden="true"></i>35,000 km</li>
                  <li><i class="fa fa-tachometer" aria-hidden="true"></i>30.000 miles</li>
                  <li><i class="fa fa-calendar" aria-hidden="true"></i>2005 model</li>
                  <li><i class="fa fa-car" aria-hidden="true"></i>Diesel</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid_listing">
            <div class="product-listing-m gray-bg">
              <div class="product-listing-img"> <a href="#"><img src="assets/images/featured-img-3.jpg" class="img-responsive" alt="image" /> </a>
                <div class="label_icon">New</div>
                <div class="compare_item">
                  <div class="checkbox">
                    <input type="checkbox" value="" id="compare13">
                    <label for="compare13">Compare</label>
                  </div>
                </div>
              </div>
              <div class="product-listing-content">
                <h5><a href="#">Maserati QUATTROPORTE 1,6</a></h5>
                <p class="list-price">$89,000</p>
                <div class="car-location"><span><i class="fa fa-map-marker" aria-hidden="true"></i> Colorado, USA</span></div>
                <ul class="features_list">
                  <li><i class="fa fa-road" aria-hidden="true"></i>35,000 km</li>
                  <li><i class="fa fa-tachometer" aria-hidden="true"></i>30.000 miles</li>
                  <li><i class="fa fa-calendar" aria-hidden="true"></i>2005 model</li>
                  <li><i class="fa fa-car" aria-hidden="true"></i>Diesel</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid_listing">
            <div class="product-listing-m gray-bg">
              <div class="product-listing-img"> <a href="#"><img src="assets/images/featured-img-1.jpg" class="img-responsive" alt="image" /> </a>
                <div class="label_icon">New</div>
                <div class="compare_item">
                  <div class="checkbox">
                    <input type="checkbox" value="" id="compare14">
                    <label for="compare14">Compare</label>
                  </div>
                </div>
              </div>
              <div class="product-listing-content">
                <h5><a href="#">Mazda CX-5 SX, V6, ABS, Sunroof </a></h5>
                <p class="list-price">$89,000</p>
                <div class="car-location"><span><i class="fa fa-map-marker" aria-hidden="true"></i> Colorado, USA</span></div>
                <ul class="features_list">
                  <li><i class="fa fa-road" aria-hidden="true"></i>35,000 km</li>
                  <li><i class="fa fa-tachometer" aria-hidden="true"></i>30.000 miles</li>
                  <li><i class="fa fa-calendar" aria-hidden="true"></i>2005 model</li>
                  <li><i class="fa fa-car" aria-hidden="true"></i>Diesel</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid_listing">
            <div class="product-listing-m gray-bg">
              <div class="product-listing-img"> <a href="#"><img src="assets/images/featured-img-2.jpg" class="img-responsive" alt="image" /> </a>
                <div class="label_icon">Used</div>
                <div class="compare_item">
                  <div class="checkbox">
                    <input  type="checkbox" value="" id="compare15">
                    <label for="compare15">Compare</label>
                  </div>
                </div>
              </div>
              <div class="product-listing-content">
                <h5><a href="#">Maserati QUATTROPORTE 1,6</a></h5>
                <p class="list-price">$89,000</p>
                <div class="car-location"><span><i class="fa fa-map-marker" aria-hidden="true"></i> Colorado, USA</span></div>
                <ul class="features_list">
                  <li><i class="fa fa-road" aria-hidden="true"></i>35,000 km</li>
                  <li><i class="fa fa-tachometer" aria-hidden="true"></i>30.000 miles</li>
                  <li><i class="fa fa-calendar" aria-hidden="true"></i>2005 model</li>
                  <li><i class="fa fa-car" aria-hidden="true"></i>Diesel</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid_listing">
            <div class="product-listing-m gray-bg">
              <div class="product-listing-img"> <a href="#"><img src="assets/images/featured-img-1.jpg" class="img-responsive" alt="image" /> </a>
                <div class="label_icon">Used</div>
                <div class="compare_item">
                  <div class="checkbox">
                    <input  type="checkbox" value="" id="compare16">
                    <label for="compare16">Compare</label>
                  </div>
                </div>
              </div>
              <div class="product-listing-content">
                <h5><a href="#">Mazda CX-5 SX, V6, ABS, Sunroof </a></h5>
                <p class="list-price">$89,000</p>
                <div class="car-location"><span><i class="fa fa-map-marker" aria-hidden="true"></i> Colorado, USA</span></div>
                <ul class="features_list">
                  <li><i class="fa fa-road" aria-hidden="true"></i>35,000 km</li>
                  <li><i class="fa fa-tachometer" aria-hidden="true"></i>30.000 miles</li>
                  <li><i class="fa fa-calendar" aria-hidden="true"></i>2005 model</li>
                  <li><i class="fa fa-car" aria-hidden="true"></i>Diesel</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid_listing">
            <div class="product-listing-m gray-bg">
              <div class="product-listing-img"> <a href="#"><img src="assets/images/featured-img-2.jpg" class="img-responsive" alt="image" /> </a>
                <div class="label_icon">New</div>
                <div class="compare_item">
                  <div class="checkbox">
                    <input type="checkbox" value="" id="compare17">
                    <label for="compare17">Compare</label>
                  </div>
                </div>
              </div>
              <div class="product-listing-content">
                <h5><a href="#">Maserati QUATTROPORTE 1,6</a></h5>
                <p class="list-price">$89,000</p>
                <div class="car-location"><span><i class="fa fa-map-marker" aria-hidden="true"></i> Colorado, USA</span></div>
                <ul class="features_list">
                  <li><i class="fa fa-road" aria-hidden="true"></i>35,000 km</li>
                  <li><i class="fa fa-tachometer" aria-hidden="true"></i>30.000 miles</li>
                  <li><i class="fa fa-calendar" aria-hidden="true"></i>2005 model</li>
                  <li><i class="fa fa-car" aria-hidden="true"></i>Diesel</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid_listing">
            <div class="product-listing-m gray-bg">
              <div class="product-listing-img"> <a href="#"><img src="assets/images/featured-img-3.jpg" class="img-responsive" alt="image" /> </a>
                <div class="label_icon">Used</div>
                <div class="compare_item">
                  <div class="checkbox">
                    <input type="checkbox" value="" id="compare18">
                    <label for="compare18">Compare</label>
                  </div>
                </div>
              </div>
              <div class="product-listing-content">
                <h5><a href="#">Maserati QUATTROPORTE 1,6</a></h5>
                <p class="list-price">$89,000</p>
                <div class="car-location"><span><i class="fa fa-map-marker" aria-hidden="true"></i> Colorado, USA</span></div>
                <ul class="features_list">
                  <li><i class="fa fa-road" aria-hidden="true"></i>35,000 km</li>
                  <li><i class="fa fa-tachometer" aria-hidden="true"></i>30.000 miles</li>
                  <li><i class="fa fa-calendar" aria-hidden="true"></i>2005 model</li>
                  <li><i class="fa fa-car" aria-hidden="true"></i>Diesel</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid_listing">
            <div class="product-listing-m gray-bg">
              <div class="product-listing-img"> <a href="#"><img src="assets/images/featured-img-3.jpg" class="img-responsive" alt="image" /> </a>
                <div class="label_icon">Used</div>
                <div class="compare_item">
                  <div class="checkbox">
                    <input  type="checkbox" value="" id="compare19">
                    <label for="compare19">Compare</label>
                  </div>
                </div>
              </div>
              <div class="product-listing-content">
                <h5><a href="#">Maserati QUATTROPORTE 1,6</a></h5>
                <p class="list-price">$89,000</p>
                <div class="car-location"><span><i class="fa fa-map-marker" aria-hidden="true"></i> Colorado, USA</span></div>
                <ul class="features_list">
                  <li><i class="fa fa-road" aria-hidden="true"></i>35,000 km</li>
                  <li><i class="fa fa-tachometer" aria-hidden="true"></i>30.000 miles</li>
                  <li><i class="fa fa-calendar" aria-hidden="true"></i>2005 model</li>
                  <li><i class="fa fa-car" aria-hidden="true"></i>Diesel</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid_listing">
            <div class="product-listing-m gray-bg">
              <div class="product-listing-img"> <a href="#"><img src="assets/images/featured-img-1.jpg" class="img-responsive" alt="image" /> </a>
                <div class="label_icon">New</div>
                <div class="compare_item">
                  <div class="checkbox">
                    <input type="checkbox" value="" id="compare20">
                    <label for="compare20">Compare</label>
                  </div>
                </div>
              </div>
              <div class="product-listing-content">
                <h5><a href="#">Mazda CX-5 SX, V6, ABS, Sunroof </a></h5>
                <p class="list-price">$89,000</p>
                <div class="car-location"><span><i class="fa fa-map-marker" aria-hidden="true"></i> Colorado, USA</span></div>
                <ul class="features_list">
                  <li><i class="fa fa-road" aria-hidden="true"></i>35,000 km</li>
                  <li><i class="fa fa-tachometer" aria-hidden="true"></i>30.000 miles</li>
                  <li><i class="fa fa-calendar" aria-hidden="true"></i>2005 model</li>
                  <li><i class="fa fa-car" aria-hidden="true"></i>Diesel</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid_listing">
            <div class="product-listing-m gray-bg">
              <div class="product-listing-img"> <a href="#"><img src="assets/images/featured-img-2.jpg" class="img-responsive" alt="image" /> </a>
                <div class="label_icon">Used</div>
                <div class="compare_item">
                  <div class="checkbox">
                    <input type="checkbox" value="" id="compare21">
                    <label for="compare21">Compare</label>
                  </div>
                </div>
              </div>
              <div class="product-listing-content">
                <h5><a href="#">Maserati QUATTROPORTE 1,6</a></h5>
                <p class="list-price">$89,000</p>
                <div class="car-location"><span><i class="fa fa-map-marker" aria-hidden="true"></i> Colorado, USA</span></div>
                <ul class="features_list">
                  <li><i class="fa fa-road" aria-hidden="true"></i>35,000 km</li>
                  <li><i class="fa fa-tachometer" aria-hidden="true"></i>30.000 miles</li>
                  <li><i class="fa fa-calendar" aria-hidden="true"></i>2005 model</li>
                  <li><i class="fa fa-car" aria-hidden="true"></i>Diesel</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="pagination">
          <ul>
            <li class="current">1</li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
          </ul>
        </div>
      </div>
     
      <!--Side-Bar-->
      <aside class="col-md-3 col-md-pull-9">
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-filter" aria-hidden="true"></i> Find Your Dream Car </h5>
          </div>
          <div class="sidebar_filter">
            <form action="#" method="get">
              <div class="form-group select">
                <select class="form-control">
                  <option>Select Location</option>
                  <option>Audi</option>
                  <option>BMW</option>
                  <option>Nissan</option>
                  <option>Toyota</option>
                  <option>Volvo</option>
                  <option>Mazda</option>
                  <option>Mercedes-Benz</option>
                  <option>Lotus</option>
                </select>
              </div>
              <div class="form-group select">
                <select class="form-control">
                  <option>Select Brand</option>
                  <option>Audi</option>
                  <option>BMW</option>
                  <option>Nissan</option>
                  <option>Toyota</option>
                  <option>Volvo</option>
                  <option>Mazda</option>
                  <option>Mercedes-Benz</option>
                  <option>Lotus</option>
                </select>
              </div>
              <div class="form-group select">
                <select class="form-control">
                  <option>Select Model</option>
                  <option>Series 1</option>
                  <option>Series 2</option>
                  <option>Series 3</option>
                  <option>Series 4</option>
                  <option>Series 6</option>
                </select>
              </div>
              <div class="form-group select">
                <select class="form-control">
                  <option>Year of Model </option>
                  <option>2016</option>
                  <option>2015</option>
                  <option>2014</option>
                  <option>2013</option>
                  <option>2012</option>
                  <option>2011</option>
                  <option>2010</option>
                  <option>2009</option>
                  <option>2008</option>
                </select>
              </div>
              <div class="form-group">
                <label class="form-label">Price Range ($) </label>
                <input id="price_range" type="text" class="span2" value="" data-slider-min="50" data-slider-max="6000" data-slider-step="5" data-slider-value="[1000,5000]"/>
              </div>
              <div class="form-group select">
                <select class="form-control">
                  <option>Type of Car </option>
                  <option>New Car</option>
                  <option>Used Car</option>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search Car</button>
              </div>
            </form>
          </div>
        </div>
        <div class="sidebar_widget sell_car_quote">
          <div class="white-text div_zindex text-center">
            <h3>Sell Your Car</h3>
            <p>Request a quote and sell your car now!</p>
            <a href="#" class="btn">Request a Quote <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a> </div>
          <div class="dark-overlay"></div>
        </div>
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-car" aria-hidden="true"></i> Recently Listed Cars</h5>
          </div>
          <div class="recent_addedcars">
            <ul>
              <li class="gray-bg">
                <div class="recent_post_img"> <a href="#"><img src="assets/images/post_200x200_1.jpg" alt="image"></a> </div>
                <div class="recent_post_title"> <a href="#">Ford Shelby GT350</a>
                  <p class="widget_price">$92,000</p>
                </div>
              </li>
              <li class="gray-bg">
                <div class="recent_post_img"> <a href="#"><img src="assets/images/post_200x200_2.jpg" alt="image"></a> </div>
                <div class="recent_post_title"> <a href="#">BMW 535i</a>
                  <p class="widget_price">$92,000</p>
                </div>
              </li>
              <li class="gray-bg">
                <div class="recent_post_img"> <a href="#"><img src="assets/images/post_200x200_3.jpg" alt="image"></a> </div>
                <div class="recent_post_title"> <a href="#">Mazda CX-5 SX, V6, ABS, Sunroof </a>
                  <p class="widget_price">$92,000</p>
                </div>
              </li>
              <li class="gray-bg">
                <div class="recent_post_img"> <a href="#"><img src="assets/images/post_200x200_4.jpg" alt="image"></a> </div>
                <div class="recent_post_title"> <a href="#">Ford Shelby GT350 </a>
                  <p class="widget_price">$92,000</p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </aside>
      <!--/Side-Bar--> 
    </div>
  </div>
</section>
<!--/Listing-grid-view--> 
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