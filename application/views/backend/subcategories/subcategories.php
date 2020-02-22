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
          <a class="btn btn-outline-success mr-2 pull-right" href="<?php echo base_url('admin/subcategory/add');?>">
            <i class="fa fa-plus"></i> Add Subcategory
          </a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                  <th>#</th>
                  <th>Subcategory</th>
                  <th>category</th>
                  <th>Date</th>
                  <th>Action</th> 
                  </tr>
                </thead>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>Subcategory</th>
                  <th>category</th>
                  <th>Date</th>
                  <th>Action</th> 
                  </tr>
                </tfoot>
                <tbody>
                <?php $i=1;foreach ($subinfo as $row):?>
                  <tr>
                    <td><?php echo $i++;?></td>
                    <td><?php echo $row['subcategory'];?></td>
                    <td><?php echo $row['category'];?></td>
                    <td><?php print date("M d, Y h:i A", strtotime($row['date_created'])); ?></td>
                    <td>
                     <a href="<?php echo site_url('/admin/subcategory/'.$row['slug']);?>" class="btn" title="edit subcategory">
                        <span class="fa fa-pencil-alt text-primary"></span>
                      </a>
                      <a href="#delete<?php echo $row['subid'];?>" title="delete subcategory" class="btn"  data-toggle="modal">
                        <i class="fa fa-trash text-danger"></i>
                      </a> 

                    </td>       
                  </tr>
                    <input type="hidden" name="subid" value="<?php echo $row['subid'];?>" >
                <?php endforeach;?>        
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
      <?php foreach($subinfo as $row):?>
        <div class="modal" id="delete<?php echo $row['subid'];?>">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete subcategory.</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">Are you sure you want to delete <?php echo $row['subcategory'];?>?</div>
              <div class="modal-footer">
                <?php echo form_open_multipart('admin/subcategory/delete/'.$row['subid']);?>
                    <input type="hidden" name="subid" value="<?php echo $row['subid'];?>" >
                    <input type="hidden" name="old_image" value="<?php echo $row['icon'];?>" >
                    <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach;?>     