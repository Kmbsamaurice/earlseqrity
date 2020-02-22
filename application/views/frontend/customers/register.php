<?php 
	if($this->session->userdata('id')):
        redirect('/'); 
  endif;

?>
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
<!-- BEGIN PRELOADING -->
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
    <a href="#" class="nav-logo"><!--i class="fab fa-envira"></i-->Register</a>
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
<div id="page-content">
  <div class="login-form">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="section-title">
            Create a new Account
          </div>
        </div>
      </div>
      <style>
            .fa{
                position:absolute;
                right:15px;
                top:15px;
                font-size:15px;
                cursor:pointer;
            }
            .fa.active{
                color:#ED502E;
            }
            p{
              color: #dc3545;
            }
    </style>
    <?php echo $this->session->flashdata('message');?>
      <div class="row">
        <form class="col s12" action="<?php echo base_url('sign-up');?>" method="post">
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <input id="firstname" type="text" name='firstname' class="validate" value="<?php echo set_value('firstname');?>">
              <label for="firstname">First Name</label>
            </div>
            <p class='text-danger'><?php echo form_error('firstname');?></p>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <input id="lastname" type="text" name='lastname' class="validate" value="<?php echo set_value('lastname');?>">
              <label for="lastname">Last Name</label>
            </div>
            <p class='text-danger'><?php echo form_error('lastname');?></p>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <input id="email" type="text" name='email' class="validate" value="<?php echo set_value('email');?>">
              <label for="email">Email Address</label>
            </div>
            <p class='text-danger'><?php echo form_error('email');?></p>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <input id="phone" type="text" name='phone' class="validate" value="<?php echo set_value('phone');?>">
              <label for="phone">Phone Number</label>
            </div>
            <p class='text-danger'><?php echo form_error('phone');?></p>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <i class="fa fa-eye" id="eye"></i>     
              <input id="pass" type="password" name='password' class="validate" value="<?php echo set_value('password');?>">
              <label for="password">Password</label>
            </div>
            <p class='text-danger'><?php echo form_error('password');?></p>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4 center">
              <input class=" btn" value="CREATE ACCOUNT" type="submit"></div>
          </div>
          </div> 
        </form>
      
      <div class="row fp-text">
        <div class="col s12">
          <div class="forgot-password-link">
            Already have an Account ? <a href="<?php echo base_url('sign-in');?>">Sign In</a>
          </div>
        </div>
      </div>

    </div>
    <div class="row">
        <div class="col s12">
          <div class="or-line">
            <div class="ol-or">OR</div>
            <div class="ol-line"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <div class="sign-in-sosmed">
            <div class="sign-in-icon sii-facebook">
              <i class="fab fa-facebook-f"></i>
            </div>
            <div class="sign-in-icon sii-twitter">
              <i class="fab fa-twitter"></i>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
<script>
    var pass=document.getElementById('pass');
    var eye=document.getElementById('eye');

    eye.addEventListener('click',togglePass);
    function togglePass(){
        eye.classList.toggle('active');
        (pass.type=='password')?pass.type='text':pass.type='password';

    }
</script>
<br>
<p><br></p>
<!-- END CONTENT-->