<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="<?php echo base_url('admin/index');?>">
    <img alt="logo" src="<?php echo base_url('assets/backend/');?>images/logo.png">
    </a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search -->
    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <div class="input-group-append">
        </div>
      </div>
    </form>
    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="<?php echo base_url('assets/backend/images/uploads/admins/').$user['image'];?>"  alt="image" class="profile-pic rounded-circle" width="30px">
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="<?php echo base_url('admin/profile');?>">Settings</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>
  </nav>
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('admin/index');?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Earl Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
      <a class="nav-link" title="categories" href="<?php echo base_url('admin/categories');?>">
         <i class="fa fa-tags"></i><span> Categories</span></a>
      </li>
      <li class="nav-item">
      <a class="nav-link" title="subcategories" href="<?php echo base_url('admin/subcategories');?>">
         <i class="fa fa-rss"></i><span>  Subcategories</span></a>
      </li>
      <li class="nav-item">
      <a class="nav-link" title="brands" href="<?php echo base_url('admin/brands');?>">
         <i class="fa fa-link"></i><span> Brands</span></a>
      </li>
      <li class="nav-item">
      <a class="nav-link" title="orders" href="<?php echo base_url('admin/orders');?>">
         <i class="fa fa-shopping-cart"></i><span> Orders</span></a>
      </li>
      <li class="nav-item">
      <a class="nav-link" title="products" href="<?php echo base_url('admin/products');?>">
         <i class="fa fa-gift"></i><span> Products</span></a>
      </li>
      <li class="nav-item">
      <a class="nav-link" title="messages" href="<?php echo base_url('admin/messages');?>">
         <i class="fa fa-envelope"></i><span> Messages</span></a>
      </li>
      <li class="nav-item">
      <a class="nav-link" title="customers" href="<?php echo base_url('admin/customers');?>">
         <i class="fa fa-users"></i><span> customers</span></a>
      </li>
      <li class="nav-item">
      <a class="nav-link" title="subscriptions" href="<?php echo base_url('admin/subscriptions');?>">
         <i class="fa fa-bell"></i><span> Subscriptions</span></a>
      </li>
      <li class="nav-item">
      <a class="nav-link" title="quotations" href="<?php echo base_url('admin/quotations');?>">
         <i class="fa fa-address-card"></i><span> Quotations</span></a>
      </li>
      <li class="nav-item">
      <a class="nav-link" title="engineers" href="<?php echo base_url('admin/engineers');?>">
         <i class="fa fa-hard-hat"></i><span> Engineers</span></a>
      </li>
      <li class="nav-item">
      <a class="nav-link" title="Logistics" href="<?php echo base_url('admin/logistics-service-providers');?>">
         <i class="fa fa-truck-moving"></i><span> Logistics</span></a>
      </li>
      <li class="nav-item">
      <a class="nav-link" title="Sale Consultants" href="<?php echo base_url('admin/sales-consultants');?>">
         <i class="fa fa-male"></i><span> Sale Consultants</span></a>
      </li>
      <li class="nav-item">
      <a class="nav-link" title="sellers" href="<?php echo base_url('admin/sellers');?>">
         <i class="fa fa-money-bill-alt"></i><span> Sellers</span></a>
      </li>
      <li class="nav-item">
      <a class="nav-link" title="admins" href="<?php echo base_url('admin/users');?>">
      <i class="fas fa-user-circle fa-fw"></i><span> Admins</span></a>
      </li>
    </ul>
