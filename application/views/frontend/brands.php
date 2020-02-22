
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Earl - Online Shop for Security Systems </title>
<meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="HandheldFriendly" content="True">
<link rel="icon" type="image/png" href="<?php echo base_url('assets/backend/');?>images/favicon.png">
<!-- CSS  -->
<link rel="stylesheet" href="<?php echo base_url('assets/frontend/lib/font-awesome/web-fonts-with-css/css/fontawesome-all.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/materialize.min.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/normalize.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/style.css');?>">
<!-- materialize icon -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- Owl carousel -->
<link rel="stylesheet" href="<?php echo base_url('assets/frontend/lib/owlcarousel/assets/owl.carousel.min.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/frontend/lib/owlcarousel/assets/owl.theme.default.min.css');?>">
<!-- Slick CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/lib/slick/slick/slick.css');?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/lib/slick/slick/slick-theme.css');?>">
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="<?php echo base_url('assets/frontend/lib/Magnific-Popup-master/dist/magnific-popup.css');?>">
</head>
<body id="homepage">
<header id="header">
<div class="nav-wrapper container">
  <div class="header-menu-button">
      <a href="#" onclick="history.go(-1)">
    <div class="cst-btn-menu">
      <i class="fas fa-arrow-left"></i>
    </div>
    </a>
  </div>
  
  <div class="header-logo">
    <a href="#" onclick="history.go(-1)" class="nav-logo"><!--i class="fab fa-envira"></i-->Shop By Brand</a>
  </div>
  <div class="header-icon-menu">
    <a href="#" data-activates="nav-mobile-account" class="button-collapse" id="button-collapse-account"><i class="far fa-user-circle"></i></a>
  </div>
  <div class="header-icon-menu cart-item-wrap">
    <a href="<?php echo base_url('cart');?>">
    <i class="fas fa-shopping-cart"></i>
    <?php if(!empty($this->cart->total_items())):?>
    <span class="cart-item">
        <?php echo $this->cart->total_items();?>
    </span>
     <?php endif;?>
    </a>
  </div>
  
    <div class="header-icon-menu">
    <a href="#" data-activates="nav-mobile-category" class="button-collapse" id="button-collapse-category">
    <i class="fas fa-search"></i>
    </a>
</div>
</div>
</header>
<!-- END HEADER -->
<!-- SIDE NAV-->
<nav>
<!-- SIDENAV CATEGORY-->
<ul id="nav-mobile-category" class="side-nav">
  <!--li class="sidenav-logo">
      <img src="assets/frontend/img/earl.png" alt="profile" style="width:80px;" class="text-center"><br>Earl Communications
    
  </li-->
    <li class="profile">
    <div class="li-profile-info">
      <img src="<?php echo base_url('assets/frontend/img/earl.png');?>" alt="profile">
      <h2>Earl Communications (U) Ltd</h2>
      <!--div class="emailprofile">Janedoe@maildomain.com</div>
      <div class="balance">
         Balance : <span>$1200</span>
      </div-->
    </div>
    <div class="bg-profile-li" style="background-color: #292728;">
    </div>
  </li>
  <li>
    <div class="search-wrapper ">
    <form action="<?php echo base_url("search");?>" method="post">
      <input type="search" id="search" name="search_string" placeholder="Find your product"><i class="material-icons"></i>
      <div class="search-results"></div>
    </form>  
    </div>
  </li>
  <?php foreach($category as $row):?>
  <?php if(empty($row->subcat)): ?>
  <li>
    <a href="<?php echo site_url('category/'.$row->slug);?>"><i class="fas fa-plus"></i> <?php echo $row->category;?></a>
  </li>
  <?php else: ?>
  <li>
    <ul class="collapsible collapsible-accordion">
      <li>
        <div class="collapsible-header">
          <i class="fas fa-plus"></i><?php echo $row->category;?> <span><i class="fas fa-caret-down"></i></span>
        </div>
        <div class="collapsible-body">
          <ul>
          <?php foreach($row->subcat as $sub):?>
            <li>
              <a class="waves-effect waves-blue" href="<?php echo site_url('subcategory/'.$sub->slug);?>"><i class="fas fa-angle-right"></i><?php echo $sub->subcategory;?></a>
            </li>
          <?php endforeach;?>
          </ul>
        </div>
      </li>
    </ul>
  </li>
  <?php endif;?>
  <?php endforeach;?>
</ul>
<!-- END SIDENAV CATEGORY-->
<!-- SIDENAV ACCOUNT-->
<ul id="nav-mobile-account" class="side-nav">
  <li class="profile">
  <?php if($this->session->userdata('id')):?>
    <div class="li-profile-info">
      <img src="<?php echo base_url('assets/frontend/img/uploads/').$customer['image'];?>" alt="profile">
        <h2> <?php echo $this->session->userdata('first_name');?></span></h2>
      <div class="emailprofile"> <?php echo $this->session->userdata('email');?></span></div>
      <a href="<?php echo base_url('profile');?>"><div class="balance">
        <span>Profile</span>
      </div></a>
    </div>
    
    <?php else: ?>
     <div class="li-profile-info">
      <img src="<?php echo base_url('assets/frontend/img/uploads/noimage.jpg');?>" alt="profile">
    </div>
    <?php endif; ?>
    <div class="bg-profile-li" style="background-image: url(assets/frontend/img/bg-profile.jpg);">
    </div>
  </li>
  <li>
    <a class="waves-effect waves-blue" href="<?php echo base_url('/');?>"><i class="fas fa-home"></i>Home</a>
  </li>
  <li>
    <a href="<?php echo base_url('wishlist');?>"><i class="fas fa-heart"></i>Wish list</a>
  </li>
   <li>
    <a href="<?php echo base_url('orders');?>"><i class="fas fa-truck "></i>My Orders</a>
  </li>
  <li>
    <a href="activity://share"><i class="fas fa-star"></i>Rate Us</a>
  </li>
  <li>
    <a href="<?php echo base_url('terms-and-conditions');?>"><i class="fas fa-gavel"></i>Terms and Conditions</a>
  </li>
  <li>
    <a href="<?php echo base_url('FAQs');?>"><i class="fas fa-question-circle"></i>Faq</a>
  </li>
  <?php if(!$this->session->userdata('id')):?>
  <li>
    <a href="<?php echo base_url('sign-in');?>"><i class="fas fa-sign-in-alt"></i>Sign in</a>
  </li>
  <?php else: ?>
  <li>
    <a href="<?php echo base_url('logout');?>"><i class="fas fa-sign-out-alt"></i>Sign Out</a>
  </li>
  <?php endif; ?>
</ul>
<!-- END SIDENAV ACCOUNT--></nav>
<!-- MAIN SLIDER -->
<div class="main-slider" data-indicators="true">
    <div class="carousel carousel-slider " data-indicators="true"> <a class="carousel-item"><img src="<?php echo base_url('assets/frontend/img/slider1.jpg');?>" alt="slider"></a> <a class="carousel-item"><img src="<?php echo base_url('assets/frontend/img/slider2.jpg');?>" alt="slider"></a> <a class="carousel-item"><img src="<?php echo base_url('assets/frontend/img/slider3.jpg');?>" alt="slider"></a> <a class="carousel-item"><img src="<?php echo base_url('assets/frontend/img/slider4.jpg');?>" alt="slider"></a> <a class="carousel-item"><img src="<?php echo base_url('assets/frontend/img/slider5.jpg');?>" alt="slider"></a> <a class="carousel-item"><img src="<?php echo base_url('assets/frontend/img/slider6.jpg');?>" alt="slider"></a> </div>
</div>
<div class="section home-category card">
    <div class="container">
        <div class="row icon-service">
            <div class="col s3 m3 l2">
                <div class="content">
                    <div class="in-content" style="background-color: #439539;">
                        <div class="in-in-content"> <i class="fas fa-file-alt" onclick="location.href='<?php echo site_url('get-quotation');?>';"></i> </div>
                    </div>
                    <h5>Quotation</h5> </div>
            </div>
            <div class="col s3 m3 l2">
                <div class="content">
                    <div class="in-content" style="background-color: #439539;">
                        <div class="in-in-content"> <i class="fas fa-money-bill-alt" onclick="location.href='<?php echo site_url('earn-with-us');?>';"></i> </div>
                    </div>
                    <h5>Earn with Us</h5> </div>
            </div>
            <div class="col s3 m3 l2">
                <div class="content">
                    <a href="tel:0784912802">
                        <div class="in-content" style="background-color: #439539;">
                            <div class="in-in-content"> <i class="fas fa-phone-volume"></i> </div>
                        </div>
                    </a>
                    <h5>Call to Order</h5> </div>
            </div>
            <div class="col s3 m3 l2">
                <div class="content">
                    <a href="top-up">
                        <div class="in-content" style="background-color: #439539;">
                            <div class="in-in-content"> <a href="<?php echo base_url('brands');?>"> <i class="fas fa-align-justify" onclick="location.href='<?php echo site_url('brands');?>';"></i> </a> </div>
                        </div>
                    </a>
                    <h5>brands</h5> </div>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col s12 card"> <img src="<?php echo base_url('assets/frontend/img/advert.jpg');?>"> </div>
        </div>
    </div>
</div>

<!--div class="container">
  <section class="card">
    <figure class="card-image loading"></figure>
    <div class="card-detail">
      <h3 class="card-title loading"></h3>
      <p class="card-description loading"></p>
    </div>
  </section>
</div-->

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col s6 card"> 
            <img src="<?php echo base_url('assets/frontend/img/ad3.jpg');?>">
            <!--div class="card-detail">
            <h3 class="card-title">Hire an Engineer</h3>
            <i class="fas fa-sign-out-alt" style="color:#ed502e;"> Order Now</i>
            </div-->
            </div>
            <div class="col s6 card">
                <img src="<?php echo base_url('assets/frontend/img/ad4.jpg');?>">
                <!--div class="card-detail">
            <h3 class="card-title">Top up Your wallet</h3>
            <i class="fa fa-plus-circle" style="color:#ed502e;"> Top-up</i>
            </div-->
                </div>
        </div>
    </div>
</div>
<!-- FEATURED PRODUCT -->
<div class="section product-item si-featured">
  <div class="container">
    <div class="row row-title">
      <div class="col s12">
        <div class="green-title">
         TOP BRANDS <span class="green-secondary-color" onclick="location.href='<?php echo site_url('all-brands');?>';">SEE ALL</span> 
        </div>
      </div>
    </div>
 </div>
  </div>
  
   <div class="row row-no-margin">
        <!-- Product item-->
        <?php foreach($brand as $row): ?>
        <div>
          <div class="col s6 m4 l3 col-produc">
              <div class="box-product">
                <div class="bp-top">
                  <div class="brand-img">
                    <div class="pli-one">
                      <div class="pli-two" onclick="location.href='<?php echo site_url('brand/'.$row['slug']);?>';">
                      <img src="<?php echo base_url('assets/backend/images/uploads/icons/').$row['icon'];?>" alt="brand-product">
                      </div>
                    </div>
                  </div>
                  <div class="item-info" onclick="location.href='<?php echo site_url('brand/'.$row['slug']);?>';"><?php echo $row["brand"];?></div>
                  <div class="price">
                     50+ Products
                  </div>
                  
                </div>
              </div>
          </div>
        </div>
        <?php endforeach; ?>
        <?php foreach($product as $row): ?>
        <div>
          <div class="col s6 m4 l3 col-produc">
              <div class="box-product">
                <div class="bp-top">
                  <div class="product-list-img" onclick="location.href='<?php echo site_url('details/'.$row['slug']);?>';">
                    <div class="pli-one">
                      <div class="pli-two">
                      <img src="<?php echo base_url('assets/backend/images/uploads/products/').$row['image1'];?>" alt="category-product">
                      </div>
                    </div>
                  </div>
                  <div class="item-info"><?php echo $row["product"];?></div>
                  <div class="price">
                     (UGX) <?php echo number_format($row["price"]);?>
                  </div>
                  <div class="stock-item" onclick="location.href='<?php echo site_url('details/'.$row['slug']);?>';">VIEW DETAILS</div>
                </div>
              </div>
          </div>
        </div>
        <?php endforeach; ?>
<!-- PROMO -->
<div class="section promo">
  <div class="container">
    <div class="col s12">
      <img  src="<?php echo base_url('assets/frontend/img/banner.jpg');?>" alt="promo" onclick="location.href='<?php echo site_url('earn-with-us');?>';">
    </div>
  </div>
</div>
<!-- END PROMO -->

       <div class="row row-title">
        <div class="col s12">
          <div class="green-title">
            NEW BRANDS<span class="green-secondary-color" onclick="location.href='<?php echo site_url('all-brands');?>';">SEE ALL</span>
          </div>
        </div>
        </div>

        <div class="row row-no-margin">
        <!-- Product item-->
        <?php foreach($new as $row): ?>
        <div>
          <div class="col s6 m4 l3 col-produc">
              <div class="box-product">
                <div class="bp-top">
                  <div class="brand-img">
                    <div class="pli-one">
                      <div class="pli-two" onclick="location.href='<?php echo site_url('brand/'.$row['slug']);?>';">
                      <img src="<?php echo base_url('assets/backend/images/uploads/icons/').$row['icon'];?>" alt="brand-product">
                      </div>
                    </div>
                  </div>
                  <div class="item-info" onclick="location.href='<?php echo site_url('brand/'.$row['slug']);?>';"><?php echo $row["brand"];?></div>
                  <div class="price">
                     50+ Products
                  </div>
                  
                </div>
              </div>
          </div>
        </div>
        <?php endforeach; ?>
        <?php foreach($newproduct as $row): ?>
        <div>
          <div class="col s6 m4 l3 col-produc">
              <div class="box-product">
                <div class="bp-top">
                  <div class="product-list-img" onclick="location.href='<?php echo site_url('details/'.$row['slug']);?>';">
                    <div class="pli-one">
                      <div class="pli-two">
                      <img src="<?php echo base_url('assets/backend/images/uploads/products/').$row['image1'];?>" alt="category-product">
                      </div>
                    </div>
                  </div>
                  <div class="item-info"><?php echo $row["product"];?></div>
                  <div class="price">
                     (UGX) <?php echo number_format($row["price"]);?>
                  </div>
                  <div class="stock-item" onclick="location.href='<?php echo site_url('details/'.$row['slug']);?>';">VIEW DETAILS</div>
                </div>
              </div>
          </div>
        </div>
        <?php endforeach; ?>
        <!-- End Product item-->