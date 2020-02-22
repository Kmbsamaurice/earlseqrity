<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('admin/index');?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Register User</li>
        </ol>
        <?php echo $this->session->flashdata('message');?>
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-body">
          <div class="col-md-3"></div>
          <form action="<?php echo base_url('admin/register');?>" method="POST" class="border border-light m-5">
          
            <div class="form-row">
               
               <div class="form-group col-md-6">
                  <label>username <span class="text-danger">*</span> </label>
                  <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo set_value('username');?>">
                  <span class="text-danger"><?php echo form_error('username');?></span>
               </div>
               <div class="form-group col-md-6">
                  <label>Email Address <span class="text-danger">*</span> </label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="<?php echo set_value('email');?>">
                  <span class="text-danger"><?php echo form_error('email');?></span>
               </div>
               <div class="form-group col-md-6">
                  <label>Role <span class="text-danger">*</span> </label>
                  <select name="role_id" id="roleid" class="form-control input-user-roleid">
                     <option value="<?php echo set_value('role_id');?>">
                            <?php 
                            if(set_value('role_id') == 1){echo "Administrator";
                              }elseif(set_value('role_id') == 2){
                                echo "member";
                              }else{
                                echo "Choose type";
                              }
                            ?>
                     </option>
                     <option value="1">Administrator</option>
                     <option value="2">member</option>
                  </select>
                  <span class="text-danger"><?php echo form_error('role_id');?></span>
               </div>
               <div class="form-group col-md-6">
                  <label>Password <span class="text-danger">*</span> </label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password"  value="<?php echo set_value('password');?>">
                  <span class="text-danger"><?php echo form_error('password');?></span>      
               </div>
               <div class="form-group col-md-6">
                  <label>Confirm Password <span class="text-danger">*</span> </label>
                  <input type="password" class="form-control" name="confirm" id="password" placeholder="Confirm Password" value="<?php echo set_value('confirm');?>">
                  <span class="text-danger"><?php echo form_error('confirm');?></span>      
               </div>      
               <div class="col-md-12 col-sm-12s field">
                  <button type="submit" class="btn btn-primary mr-2">Save</button>
                  <a class="btn btn-light" href="<?php echo base_url('admin/users');?>">Cancel</a>
                  </div>
               </div>
               </form>
               </div>
            </div>
          </div>
        </div>
      </div>      
      <!-- /.container-fluid -->