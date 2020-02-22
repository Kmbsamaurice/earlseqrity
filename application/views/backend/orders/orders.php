<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('admin/index');?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Orders</li>
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
                <th>Customer</th>
                <th>Phone</th>
                <th>Delivery Address</th>
                <th>Order status</th>
                <th>Payment status</th>
                <th>Action</th>
              </tr>
                </thead>
                <tfoot>
                <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Delivery Address</th>
                <th>Order status</th>
                <th>Payment status</th>
                <th>Action</th>
              </tr>
                </tfoot>
                <tbody>
                    <?php $i=1; foreach($orders as $element): ?>
                      <tr class="catcls-<?php echo $element->order_id;?>">
                            <td><?php echo $i++; ?></td>                       
                            <td><?php echo $element->first_name ." " .$element->last_name; ?></td>
                            <td><?php echo $element->phone; ?></td>
                            <td><?php echo $element->address; ?></td>
                            <td><?php echo $element->order_status; ?></td>
                            <td><?php echo $element->payment_status; ?></td>
                            <td>
                            <a href="order/view/<?php echo urlencode(strtolower($element->order_id)); ?>" class="btn text-success" title="view order">
                                view
                            </a>
                            <?php if($element->order_status=='PENDING') : ?>
                            <a href="order/confirm/<?php echo urlencode(strtolower($element->order_id)); ?>" class="btn text-info" title="confirm order">
                                order
                            </a>
                            <?php endif;?>
                            <?php if($element->payment_status=='PENDING' && $element->order_status=='CONFIRMED') : ?>
                            <a href="order/payment/<?php echo urlencode(strtolower($element->order_id)); ?>" class="btn text-warning" title="confirm payment">
                                payment
                            </a>
                            <?php endif;?>
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
      