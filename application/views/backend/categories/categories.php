<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('admin/index');?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Categories</li>
        </ol>
        <?php echo $this->session->flashdata('message');?>
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
          <a class="btn btn-outline-success mr-2 pull-right" href="<?php echo base_url('admin/category/add');?>">
            <i class="fa fa-plus"></i> Add category
          </a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                  <th>#</th>
                  <th>Icon</th>
                  <th>category</th>
                  <th>Date</th>
                  <th>Action</th> 
                  </tr>
                </thead>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>Icon</th>
                  <th>category</th>
                  <th>Date</th>
                  <th>Action</th> 
                  </tr>
                </tfoot>
                <tbody>
                <?php $i=1;foreach ($catinfo as $row):?>
                  <tr>
                    <td>
                      <?php echo $i++;?></td>
                            <td class="py-1">
                                 <img src="<?php echo base_url('assets/backend/images/uploads/icons/').$row['icon'];?>"  alt="image" class="icon-pic rounded-circle" width="35px">
                            </td>
                            <td><?php echo $row['category'];?></td>
                            <td><?php print date("M d, Y h:i A", strtotime($row['date_created'])); ?></td>
                            <td>
                                <a href="<?php echo site_url('/admin/category/'.$row['slug']);?>" class="btn" title="edit category">
                                    <span class="fa fa-pencil-alt text-primary"></span>
                                </a>
                                <a href="#delete<?php echo $row['catid'];?>" title="delete category" class="btn"  data-toggle="modal">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>
                            </td>       
                    </tr>     
                <?php endforeach;?>        
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
      <?php foreach($catinfo as $row):?>
        <div class="modal" id="delete<?php echo $row['catid'];?>">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">DELETE CATEGORY.</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">Are you sure you want to delete <?php echo $row['category'];?>?</div>
              <div class="modal-footer">
                <?php echo form_open_multipart('admin/category/delete/'.$row['catid']);?>
                    <input type="hidden" name="catid" value="<?php echo $row['catid'];?>" >
                    <input type="hidden" name="old_image" value="<?php echo $row['icon'];?>" >
                    <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach;?> 