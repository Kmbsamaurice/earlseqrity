<?php 
	if(!$this->session->userdata('id')):
		$this->session->set_flashdata('message','<div class="alert alert-danger role="alert">
        Please first signin to confirm your order.</div>');
        redirect('sign-in'); 
  endif;

?>
<!-- CONTENT -->
<div id="page-content" class="shipping-checkout-page">
  <div class="cart-page">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="section-title">Order Confirmation</div>
        </div>
      </div>
      <style>
            p{
              color: #dc3545;
            }
    </style>
      <br>
      <?php if($this->session->flashdata('message')): ?>
      <?php echo $this->session->flashdata('message');?>
      <?php else: ?>
        <div class="alert alert-success" role="alert">Your Order has been sent successfully.We'll contact you soon with the delivery details.</div>
      <?php endif; ?>
<?php if( $order_details->order_status='PENDING'): ?>
<div style="margin: 0px 0px 10px; font-weight:bold;">Order Details :</div>
<table class="u-full-width">
  <!--thead>
    <tr>
      <th >Order Details:</th>
    </tr>
  </thead-->
  <tbody>
    <tr>
      <td>Customer</td>
      <td><div class="u-pull-right"><?php echo $shipping->first_name ." " .$shipping->last_name; ?></div></td>
    </tr>
    <tr>
      <td>Phone</td>
      <td ><div class="u-pull-right"><?php echo $shipping->phone; ?></div></td>
    </tr>
     <tr>
      <td >Delivery Address</td>
      <td><div class="u-pull-right"><?php echo ($shipping->address); ?></div></td>
    </tr>
     <tr>
      <td>Order Confirmation</td>
      <td><div class="u-pull-right"><?php echo $order_details->order_status; ?></div></td>
    </tr>
     <tr>
      <td>Order Total</td>
      <td><div class="u-pull-right"><?php echo $order_details->order_total; ?></div></td>
    </tr>
  </tbody>
</table>
<?php endif; ?>
<br>
<p><br></p>
<!-- END CONTENT-->