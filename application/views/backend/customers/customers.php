<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('admin/index');?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Customers</li>
        </ol>
        <?php echo $this->session->flashdata('message');?>
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                  <th>#</th>
                  <th>Image</th>
                  <th>First name</th>
                  <th>Last name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Date</th> 
                  </tr>
                </thead>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>Image</th>
                  <th>First name</th>
                  <th>Last name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Date</th>  
                  </tr>
                </tfoot>
                <tbody>
                <?php $i=1;foreach ($customer as $row):?>
                  <tr>
                    <td>
                      <?php echo $i++;?></td>
                            <td class="py-1">
                                 <img src="<?php echo base_url('assets/frontend/img/uploads/').$row['image'];?>"  alt="image" class="icon-pic rounded-circle" width="35px">
                            </td>
                            <td><?php echo $row['first_name'];?></td>
                            <td><?php echo $row['last_name'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['phone'];?></td>
                            <td><?php print date("M d, Y h:i A", strtotime($row['date_created'])); ?></td>    
                    </tr>     
                <?php endforeach;?>        
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
   