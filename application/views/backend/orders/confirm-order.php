<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('admin/index');?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Confirm Order</li>
        </ol>
        <?php echo $this->session->flashdata('message');?>
        <div class="card mb-3">
          <div class="card-header">
            <a class="btn btn-outline-info mr-2 pull-right" href="<?php echo base_url(strtolower('admin/orders')); ?>">
              Back 
            </a>
          </div>
        </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                <th>Order Number</th>
                <th>Product</th>
                <th>Price(USH)</th>
                <th>Quantity</th>
                <th>Order Date</th>
              </tr>
                </thead>
                <tfoot>
                    <tr class="m-0 font-weight-bold text-success">
                        <td colspan="4">TOTAL WITH VAT</td>
                        <td><?php echo "USH ". ($order_details->order_total);?></td>
                    </tr>
                    <tr>
                        <td colspan="4">CONFIRMATION</td>
                        <td colspan="6">
                        <?php if( $order_details->order_status='PENDING'): ?>
                                <a href="<?php echo base_url('admin/order/received/'.$order_details->order_id); ?>" class="btn text-primary " title="confirm order">
                                   CONFIRM ORDER
                                </a>
                            <?php endif;?>  
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $i=1; foreach($ordered as $element): ?>
                      <tr class="catcls-<?php echo $element->order_id;?>">
                            <td><?php echo $i++; ?></td>                       
                            <td><?php echo $element->product ; ?></td>
                            <td><?php echo number_format($element->price); ?></td>
                            <td><?php echo $element->sold_quantity; ?></td>
                            <td><?php print date("M d, Y h:i A", strtotime($element->date_created)); ?></td>
                      </tr>
                    <?php endforeach;?>      
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
      