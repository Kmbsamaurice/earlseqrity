<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('admin/index');?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Subscriptions</li>
        </ol>
        <?php echo $this->session->flashdata('message');?>
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
          <a class="btn btn-outline-success mr-2 pull-right" href="<?php echo base_url('admin/subscription/add');?>">
            <i class="fa fa-plus"></i> Send Newsletter
          </a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                  <th>#</th>
                  <th>Email</th>
                  <th>verification</th>
                  <th>Date</th>
                  </tr>
                </thead>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>Email</th>
                  <th>verification</th>
                  <th>Date</th>  
                  </tr>
                </tfoot>
                <tbody>
                <?php $i=1;foreach ($subinfo as $row):?>
                  <tr>
                    <td>
                      <?php echo $i++;?></td>
                        <td><?php echo $row['email'];?></td>
                        <td>
                        <?php 
                            if($row['verify']=1):
                                echo 'VERIFIED';
                            endif;
                        ?>
                        </td>
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
   