<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('admin/index');?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Users</li>
        </ol>
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
          <a class="btn btn-outline-success btn-sm pull-right" href="<?php echo base_url('admin/register');?>">
              <i class="fa fa-plus"></i> Add user
            </a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Image</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Date</th> 
                  </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Image</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Date</th> 
                </tr>
                </tfoot>
                <tbody>
                <?php foreach ($userinfo as $row):?>
                        <tr>
                            <td class="py-1">
                                 <img src="<?php echo base_url('assets/backend/images/uploads/admins/').$user['image'];?>"  alt="image" class="profile-pic rounded-circle" width="35px">
                            </td>
                            <td><?php echo $row['username'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td>
                                <?php 
                                if($row['role_id'] == 1){
                                    echo "Administrator";
                                  }elseif($row['role_id'] == 2){
                                    echo "member";
                                  }else{
                                    echo "No Role";
                                  }
                                ?>
                            </td>
                            <td><?php echo date("d-m-Y g:i A", strtotime($row['date_created']));?></td>
                        </tr>
                <?php endforeach;?>     
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->