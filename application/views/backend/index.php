<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('admin/index');?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div>
                <div class="mr-5"><?php echo $messages;?> messages</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="<?php echo base_url('admin/messages');?>">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-list"></i>
                </div>
                <div class="mr-5"><?php echo $subscriptions;?> subscriptions</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="<?php echo base_url('admin/subscriptions');?>">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5"><?php echo $orderscount;?> orders</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="<?php echo base_url('admin/orders');?>">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5"><?php echo $customers;?> customers</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="<?php echo base_url('admin/customers');?>">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>
        <!-- Area Chart Example-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Order chart</div>
          <div class="card-body">
            <canvas id="myAreaChart" width="100%" height="30"></canvas>
          </div>
        </div>
        <?php
            function changetime(){
                date_default_timezone_set("Africa/Nairobi");
                echo " ",date("M d, Y H:i:s A");
            }
            changetime();
        ?>
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-shopping-cart"></i>
            Recent orders</div>
            <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Delivery Address</th>
                <th>status</th>
                <th>Order Date</th>
                <th>Action</th>
              </tr>
                </thead>
                <tfoot>
                <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Delivery Address</th>
                <th>status</th>
                <th>Order Date</th>
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
                            <td><?php print date("M d, Y h:i A", strtotime($element->date_created)); ?></td>
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

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-shopping-cart"></i>
            Recent confirmations</div>
            <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Delivery Address</th>
                <th>order status</th>
                <th>Order Date</th>
                <th>Action</th>
              </tr>
                </thead>
                <tfoot>
                <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Delivery Address</th>
                <th>order status</th>
                <th>Order Date</th>
                <th>Action</th>
              </tr>
                </tfoot>
                <tbody>
                    <?php 
                        date_default_timezone_set('Africa/Nairobi'); 
                        $i=1; 
                        foreach($orders as $element):
                    ?>
                      <?php if($element->order_status=='CONFIRMED') : ?>
                      <tr class="catcls-<?php echo $element->order_id;?>">
                            <td><?php echo $i++; ?></td>                       
                            <td><?php echo $element->first_name ." " .$element->last_name; ?></td>
                            <td><?php echo $element->phone; ?></td>
                            <td><?php echo $element->address; ?></td>
                            <td><?php echo $element->order_status; ?></td>
                            <td><?php print date("d-M-Y H:i:s", strtotime($element->date_created)); ?></td>
                            <td>
                              <a href="order/view/<?php echo urlencode(strtolower($element->order_id)); ?>" class="btn text-success" title="view order">
                                  view
                              </a>
                            </td>
                          </tr>
                      <?php endif;?>
                    <?php endforeach;?>      
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-shopping-cart"></i>
            Recent payments</div>
            <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Delivery Address</th>
                <th>payment status</th>
                <th>Order Date</th>
                <th>paid</th>
                <th>Action</th>
              </tr>
                </thead>
                <tfoot>
                <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Delivery Address</th>
                <th>payment status</th>
                <th>Order Date</th>
                <th>paid</th>
                <th>Action</th>     
                </tfoot>
                <tbody>
                    <?php $i=1; foreach($orders as $element): ?>
                      <?php if($element->payment_status=='PAID') : ?>
                      <tr class="catcls-<?php echo $element->order_id;?>">
                            <td><?php echo $i++; ?></td>                       
                            <td><?php echo $element->first_name ." " .$element->last_name; ?></td>
                            <td><?php echo $element->phone; ?></td>
                            <td><?php echo $element->address; ?></td>
                            <td><?php echo $element->payment_status; ?></td>
                            <td><?php print date("M d, Y h:i A", strtotime($element->date_created)); ?></td>
                            <td><?php echo $element->order_total; ?></td>
                            <td>
                              <a href="order/view/<?php echo urlencode(strtolower($element->order_id)); ?>" class="btn text-success" title="view order">
                                  view
                              </a>
                            </td>
                      </tr>
                      <?php endif;?>
                    <?php endforeach;?>      
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->