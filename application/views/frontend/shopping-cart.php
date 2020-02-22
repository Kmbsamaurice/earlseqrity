
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
<script type="application/javascript" src="<?php echo base_url('assets/frontend/js/fastclick.js');?>"></script>
<script type="application/javascript">
	window.addEventListener('load', function() {
		new FastClick(document.body);
		document.getElementById('select').addEventListener('focus', function(event) {
			event.target.setSelectionRange(0, event.target.value.length);
		}, false);
	}, false);
</script>
</head>
<body id="homepage">
<!-- BEGIN PRELOADING -->
<!--div-- class="preloading">
  <div class="wrap-preload">
    <div class="cssload-loader"></div>
  </div>
</!--div-->
<!-- END PRELOADING -->
<!-- HEADER -->
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
    <a href="#" class="nav-logo"><!--i class="fab fa-envira"></i-->Shopping Cart</a>
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
<!-- CONTENT -->
<div id="page-content">
  <div class="cart-page">
    <div class="container">
      <!--div class="row">
        <div class="col s12">
          <div class="section-title">
            Shopping Cart
          </div>
        </div>
      </div-->
      <div class="row">
        <?php $content =$this->cart->contents(); ?>
        <?php if(!empty($content)): ?>
        <div class="col s12">
          <div class="cart-box">
            <!-- item-->
            <?php foreach($content as $cart):?>
            <div class="cart-item">
              <div class="ci-img">
                <div class="ci-img-product">
                    <img src="<?php echo base_url('assets/backend/images/uploads/products/').$cart['options']['image1'];?> " alt="<?php print $cart['name'];?>" >
                </div>
              </div>
              <div class="ci-name">
                <div class="cin-top">
                  <div class="cin-title"><?php print word_limiter($cart['name'],3);?> </div>
                </div>
              </div>
               <div class="ci-remove">
                <div class="cin-top">
                  <div class="cin-price">
                      <i class="fa fa-heart" style="font-size:17px; margin-right:30px;"></i>
                      <i class="fa fa-trash" style="font-size:17px; margin-right:20px;"onclick="location.href='<?php echo site_url('delete/'.$cart['rowid']);?>';"> Remove</i>
                  <div class="cart-price" style="font-size:15px; margin-right:10px;"> UGX <?php print number_format($cart['price']);?> </div></div>
                </div>
              </div>
              <div class="ci-price">
                <div class="qty-total-price">
                  <div class="qty-prc">
                  
                    <div class="quantity">
                        <form action="<?php echo base_url("update/". $cart['rowid']);?>" method="post">
                        <input type="hidden" name="rowid" value="<?php echo $cart['rowid'];?>">
                        <input type="number" name="qty" min="1" max="9999" value="<?php echo $cart['qty'];?>">
                        <button type="submit" class="quantity-button quantity-up">+</button>
                        <button type="submit" class="quantity-button quantity-down">-</button>
                        </form>
                      </div>
                </div>
              </div>
              <div style="clear: both"></div>
            </div>
            <?php endforeach;?>
            <!-- end item-->
            </div>
          <div class="checkout-payable">
          <div class="cart-cp cart-total">
              <div class="cp-left">ITEMS</div>
              <div class="cp-right"><?php echo $this->cart->total_items(); ?></div>
            </div>
            <div class="cart-cp cart-total-payable">
              <div class="cp-left">Grand Total</div>
              <div class="cp-right">
                UGX <?php echo $grand= number_format($this->cart->total());?>
                <?php
                  $sdata =array();
                  $sdata['total'] =  $grand;
                  $this->session->set_userdata($sdata);
                ?>
                </div>
            </div>

        </div>
<div class="mobile-bottom-bar2">
    <div class="row ">
        <div class="col s12 container">
        <div class="col s6">
            <button class="continue-link" onclick="location.href='<?php echo site_url('/');?>';">Continue Shopping</button></div>
            
        <div class="col s6">
            <?php
            $customer_id=$this->session->userdata('id');
            $shipping_id=$this->session->userdata('shipping_id');
            ?>
            <button class="checkout-link" onclick="location.href='<?php echo site_url('check-out');?>';">Checkout <i class="fas fa-arrow-circle-right"></i></button>
        </div>
    </div>
</div>
</div>
        <br><br>
        </div>
        <?php else: ?>
            <div class="col s12 container">
                <div class="col s12 alert alert-danger">
                    YOUR SHOPPING CART IS EMPTY.
                </div>
            </div>
        <?php endif;?>
      </div>
    </div>
   
  </div>
</div>


<!-- END CONTENT -->
<!--div class="qty-total-price">
    <div class="container">
      <div class="row">
        <div class="col s4">
        </div>
        <div class="col s8">
          <div class="qty-prc">
            <div class="quantity">
              <input type="hidden" name="id" min="1" value="">
              <input type="number" name="quantity" min="1" max="9999" step="1" value="1">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div-->
</div>