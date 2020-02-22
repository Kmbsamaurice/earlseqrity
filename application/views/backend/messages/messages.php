<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('admin/index');?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Messages</li>
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
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Message</th>
                  <th>Date</th>
                  <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Message</th>
                  <th>Date</th>
                  <th>Action</th> 
                  </tr>
                </tfoot>
                <tbody>
                <?php $i=1;foreach ($message as $row):?>
                  <tr>
                    <td>
                      <?php echo $i++;?></td>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['phone'];?></td>
                        <td><?php echo word_limiter($row['message'],3);?></td>
                        <td><?php print date("M d, Y h:i A", strtotime($row['date_created'])); ?></td>
                        <td>
                        <a href="#view<?php echo $row['id']; ?>" class="btn" title="view message" data-toggle="modal">
                          <span class="fa fa-eye text-success"></span>
                        </a>
                        <a href="#delete<?php echo $row['id'];?>" title="delete message" class="btn"  data-toggle="modal">
                            <i class="fa fa-trash text-danger"></i>
                        </a>
                        <a href="#">Reply</a>
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

      <?php foreach($message as $row):?>
        <div class="modal" id="view<?php echo $row['id'];?>">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">VIEW MESSAGE.</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
              <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" href="#profile<?php echo $row['id']; ?>" role="tab" data-toggle="tab">view</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#details<?php echo $row['id']; ?>" role="tab" data-toggle="tab">Details</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#message<?php echo $row['id']; ?>" role="tab" data-toggle="tab">Message</a>
              </li>
            </ul>
            <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="profile<?php echo $row['id']; ?>">...</div>
            <div role="tabpanel" class="tab-pane fade" id="details<?php echo $row['id']; ?>">
              <div class="table-responsive">
                  <table class="table table-boredered">
                    <tr>
                      <td><strong>Name</strong></td>
                      <td><?php echo $row['name']; ?></td>
                    </tr>
                    <tr>
                      <td><strong>Email</strong></td>
                      <td><?php echo $row['email']; ?></td>
                    </tr>
                    <tr>
                      <td><strong>Phone</strong></td>
                      <td><?php echo $row['phone']; ?></td>
                    </tr>
                    <tr>
                      <td><strong>Subject</strong></td>
                      <td>
                          <?php
                            if(!empty($row['subject'])):
                             echo $row['subject']; 
                          else: 
                            echo "NO SUBJECT";
                          endif;
                          ?>
                      </td>
                    </tr>
                    <tr>
                      <td><strong>Date created</strong></td>
                      <td><?php print date("M d, Y h:i A", strtotime($row['date_created'])); ?></td>
                    </tr>
                  </table>
                </div>
               </div>
               <div role="tabpanel" class="tab-pane fade" id="message<?php echo $row['id']; ?>">
              <div class="table-responsive">
            <table class="table table-boredered">
                <tr>
                    <td><?php echo $row['message']; ?></td>
                </tr>
            </table>
            </div>
            </div>
               <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
              </div>
              </div>
              </div>
            </div>
          </div>
        </div>


        <div class="modal" id="delete<?php echo $row['id'];?>">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">DELETE MESSAGE.</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">Are you sure you want to delete this message?</div>
              <div class="modal-footer">
                <?php echo form_open_multipart('admin/message/delete/'.$row['id']);?>
                    <input type="hidden" name="id" value="<?php echo $row['id'];?>" >
                    <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach;?>  