<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Earl - Dashboard</title>
  <link rel="icon" type="image/png" href="<?php echo base_url('assets/backend/');?>images/favicon.png">
  <link href="<?php echo base_url('assets/backend/');?>css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/backend/');?>css/sb-admin.css" rel="stylesheet">
</head>
<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">SIGN IN</div>
      <div class="card-body">
      <?php echo $this->session->flashdata('message');?>
        <form method="post" action="<?php echo base_url('admin/login');?>">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" value="<?php echo set_value('email');?>" autofocus="autofocus">
              <label for="inputEmail">Email address</label>
              <span class="text-danger"><?php echo form_error('email');?></span>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password"  name="password" id="inputPassword" class="form-control" placeholder="Password">
              <label for="inputPassword">Password</label>
              <span class="text-danger"><?php echo form_error('password');?></span>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Remember Me
              </label>
            </div>
          </div>
          <button type="submit" class="btn btn-block btn-primary btn-lg">sign in</button>
        </form>
        <div class="text-center">
          <a class="d-block small" href="#">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>
  <script src="<?php echo base_url('assets/backend/');?>jquery.min.js"></script>
  <script src="<?php echo base_url('assets/backend/');?>js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url('assets/backend/');?>jquery.easing.min.js"></script>
</body>
</html>
