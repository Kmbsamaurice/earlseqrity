<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('admin/index');?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">ORDER DETAILS</li>
        </ol>
        <?php echo $this->session->flashdata('message');?>
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            Delivery details
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead>
                <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Delivery Address</th>
                <th>Email</th>
              </tr>
                </thead>
                <tfoot>
                <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Delivery Address</th>
                <th>Email</th>
              </tr>
                </tfoot>
                <tbody>
                <?php $i=1; ?>
                      <tr>
                            <td><?php echo $i++; ?></td>                       
                            <td><?php echo $shipping->first_name ." " .$shipping->last_name; ?></td>
                            <td><?php echo $shipping->phone; ?></td>
                            <td><?php echo $shipping->address; ?></td>
                            <td><?php echo $shipping->email; ?></td>
                      </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            order details
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead>
                <tr>
                <th>#</th>
                <th>Product</th>
                <th>Price(USH)</th>
                <th>Quantity</th>
                <th>Sub total</th>
                <th>Order date</th>
              </tr>
                </thead>
                <tfoot>
                <tr>
                <th>#</th>
                <th>Product</th>
                <th>Price(USH)</th>
                <th>Quantity</th>
                <th>Sub total</th>
                <th>Order date</th>
              </tr>
                </tfoot>
                <tbody>
                <?php $i=1; foreach($ordered as $order):?>
                    <tr>
                        <td><?php echo $i++;?></td>
                        <td><?php echo word_limiter($order->product,3);?></td>
                        <td><?php echo number_format($order->price);?></td>
                        <td><?php echo $order->sold_quantity;?></td>
                        <td><?php echo number_format($order->price * $order->sold_quantity);?></td>
                        <td><?php echo date("d-M-Y H:i:s", strtotime($order->date_created));?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- DataTables Example -->
      <div class="card mb-3">
          <div class="card-header">
          Customer Information
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone number</th>
              </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone number</th>
              </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td><?php echo $customer->first_name;?></td>
                        <td><?php echo $customer->last_name;?></td>
                        <td><?php echo $customer->phone;?></td>
                    </tr>
                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>
      <!-- /.container-fluid -->
      