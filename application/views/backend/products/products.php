<div id="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo base_url('admin/index'); ?>">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Products</li>
    </ol>
    <?php echo $this->session->flashdata('message'); ?>
    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <a class="btn btn-outline-success mr-2 pull-right" href="<?php echo base_url('admin/product/add'); ?>">
          <i class="fa fa-plus"></i> Add product
        </a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>product</th>
                <th>Description</th>
                <th>Price (USH)</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>#</th>
                <th>product</th>
                <th>Description</th>
                <th>Price (USH)</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
              <?php $i = 1;
              foreach ($productinfo as $key => $element) : ?>
                <tr class="productcls-<?php print $element['id']; ?>">
                  <td><?php print $i++; ?></td>
                  <td><?php print $element['product']; ?></td>
                  <td><?php print word_limiter($element['description'], 3); ?></td>
                  <td><?php print number_format($element['price']); ?></td>
                  <td>
                    <a href="#view<?php echo $element['id']; ?>" class="btn" title="view <?php print $element['product']; ?>" data-toggle="modal">
                      <span class="fa fa-eye text-success"></span>
                    </a>
                    <a href="<?php echo base_url('/admin/product/' . $element['slug']); ?>" class="btn" title="edit <?php print $element['product']; ?>">
                      <span class="fa fa-pencil-alt text-primary"></span>
                    </a>
                    <a href="#delete<?php echo $element['id']; ?>" title="delete <?php print $element['product']; ?>" class="btn" data-toggle="modal">
                      <i class="fa fa-trash text-danger"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
  <?php foreach ($productinfo as $row) : ?>
    <div class="modal" id="delete<?php echo $row['id']; ?>">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">DELETE PRODUCT.</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Are you sure you want to delete <?php echo $row['product']; ?>?</div>
          <div class="modal-footer">
            <?php echo form_open_multipart('admin/product/delete/' . $row['id']); ?>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="old_image" value="<?php echo $row['image1']; ?>">
            <input type="hidden" name="old_image1" value="<?php echo $row['image2']; ?>">
            <input type="hidden" name="old_image2" value="<?php echo $row['image3']; ?>">
            <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-danger" type="submit">Delete</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!--View Modal -->
    <div class="modal" id="view<?php echo $row['id']; ?>">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">VIEW PRODUCT.</h5>
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
                <a class="nav-link" href="#product<?php echo $row['id']; ?>" role="tab" data-toggle="tab">product</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#buzz<?php echo $row['id']; ?>" role="tab" data-toggle="tab">Images</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#references<?php echo $row['id']; ?>" role="tab" data-toggle="tab">Description</a>
              </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade in active" id="profile<?php echo $row['id']; ?>">...</div>
              <div role="tabpanel" class="tab-pane fade" id="product<?php echo $row['id']; ?>">
                <div class="table-responsive">
                  <table class="table table-boredered">
                    <tr>
                      <td><strong>Product</strong></td>
                      <td><?php echo $row['product']; ?></td>
                    </tr>
                    <tr>
                      <td><strong>Category</strong></td>
                      <td><?php echo $row['category']; ?></td>
                    </tr>
                    <tr>
                      <td><strong>Subcategory</strong></td>
                      <td><?php echo $row['subcategory']; ?></td>
                    </tr>
                    <tr>
                      <td><strong>Brand</strong></td>
                      <td><?php echo $row['brand']; ?></td>
                    </tr>
                    <tr>
                      <td><strong>Price(USH)</strong></td>
                      <td><?php echo number_format($row['price']); ?></td>
                    </tr>
                    <tr>
                      <td><strong>New Price(USH)</strong></td>
                      <td><?php echo number_format($row['new_price']); ?></td>
                    </tr>
                    <tr>
                      <td><strong>Date created</strong></td>
                      <td><?php print date("M d, Y h:i A", strtotime($row['date_created'])); ?></td>
                    </tr>
                  </table>
                </div>
              </div>

              <div role="tabpanel" class="tab-pane fade" id="buzz<?php echo $row['id']; ?>">
                <div class="table-responsive">
                  <table class="table table-boredered">
                    <tr>
                      <td><strong>Image one</strong></td>
                      <td>
                        <img src="<?php echo base_url('assets/backend/images/uploads/products/') . $row['image1']; ?>" alt="product-image" class="rounded-circle" width="100px">
                      </td>
                    </tr>
                    <tr>
                      <td><strong>Image two</strong></td>
                      <td>
                        <img src="<?php echo base_url('assets/backend/images/uploads/products/') . $row['image2']; ?>" alt="product-image" class="rounded-circle" width="100px">
                      </td>
                    </tr>
                    <tr>
                      <td><strong>Image three</strong></td>
                      <td>
                        <img src="<?php echo base_url('assets/backend/images/uploads/products/') . $row['image3']; ?>" alt="product-image" class="rounded-circle" width="100px">
                      </td>
                    </tr>
                  </table>
                </div>

              </div>
              <div role="tabpanel" class="tab-pane fade" id="references<?php echo $row['id']; ?>">
                <h6>Description</h6>
                <p>
                  <?php echo $row['description']; ?>
                </p>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>