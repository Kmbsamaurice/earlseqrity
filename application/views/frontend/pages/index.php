<div class="main-slider" data-indicators="true">
    <div class="carousel carousel-slider " data-indicators="true"> <a class="carousel-item"><img src="<?php echo base_url('assets/frontend/img/slider1.jpg');?>" alt="slider"></a> <a class="carousel-item"><img src="<?php echo base_url('assets/frontend/img/slider2.jpg');?>" alt="slider"></a> <a class="carousel-item"><img src="<?php echo base_url('assets/frontend/img/slider3.jpg');?>" alt="slider"></a> <a class="carousel-item"><img src="<?php echo base_url('assets/frontend/img/slider4.jpg');?>" alt="slider"></a> <a class="carousel-item"><img src="<?php echo base_url('assets/frontend/img/slider5.jpg');?>" alt="slider"></a> <a class="carousel-item"><img src="<?php echo base_url('assets/frontend/img/slider6.jpg');?>" alt="slider"></a> </div>
</div>
<div class="section home-category card">
    <div class="container">
        <div class="row icon-service">
            <div class="col s3 m3 l2">
                <div class="content">
                    <div class="in-content" style="background-color: #4671c6;">
                        <div class="in-in-content"> <i class="fas fa-file-alt" onclick="location.href='<?php echo site_url('get-quotation');?>';"></i> </div>
                    </div>
                    <h5>Quotation</h5> </div>
            </div>
            <div class="col s3 m3 l2">
                <div class="content">
                    <div class="in-content" style="background-color: #F91313;">
                        <div class="in-in-content"> <i class="fas fa-money-bill-alt" onclick="location.href='<?php echo site_url('earn-with-us');?>';"></i> </div>
                    </div>
                    <h5>Earn with Us</h5> </div>
            </div>
            <div class="col s3 m3 l2">
                <div class="content">
                    <a href="tel:0784912802">
                        <div class="in-content" style="background-color: #D8990E;">
                            <div class="in-in-content"> <i class="fas fa-phone-volume"></i> </div>
                        </div>
                    </a>
                    <h5>Call to Order</h5> </div>
            </div>
            <div class="col s3 m3 l2">
                <div class="content">
                    <a href="top-up">
                        <div class="in-content" style="background-color: #FF8300;">
                            <div class="in-in-content"> <a href="<?php echo base_url('brands');?>"> <i class="fas fa-align-justify" onclick="location.href='<?php echo site_url('brands');?>';"></i> </a> </div>
                        </div>
                    </a>
                    <h5>brands</h5> </div>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col s12 card"> <img src="<?php echo base_url('assets/frontend/img/advert.jpg');?>"> </div>
        </div>
    </div>
</div>

<!--div class="container">
  <section class="card">
    <figure class="card-image loading"></figure>
    <div class="card-detail">
      <h3 class="card-title loading"></h3>
      <p class="card-description loading"></p>
    </div>
  </section>
</div-->

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col s6 card adverts"> 
            <img src="<?php echo base_url('assets/frontend/img/ad3.jpg');?>">
            <!--div class="card-detail">
            <h3 class="card-title">Hire an Engineer</h3>
            <i class="fas fa-sign-out-alt" style="color:#ed502e;"> Order Now</i>
            </div-->
            </div>
            <div class="col s6 card adverts">
                <img src="<?php echo base_url('assets/frontend/img/ad4.jpg');?>">
                <!--div class="card-detail">
            <h3 class="card-title">Top up Your wallet</h3>
            <i class="fa fa-plus-circle" style="color:#ed502e;"> Top-up</i>
            </div-->
                </div>
        </div>
    </div>
</div>
<div class="section subscribe">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="section-title">Sign Up for our newsletter</div>
                <p class="left" style="font-size:10px;">Get information on our sales preview, new technologies and promotions</p>
                <form method="POST" action="<?php echo site_url('subscribe');?>">
                    <div class="mail-subscribe-box col s8">
                        <input class="form-control" name="email" placeholder="Enter your Email here" value="" type="email"> </div>
                    <div class="col s4">
                        <button class="btn">SEND</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="section product-item si-featured">
    <div class="container">
        <div class="row row-title">
            <div class="col s12">
                <div class="orange-title"> CCTV CAMERAS <span class="orange-secondary-color">SEE ALL</span> </div>
            </div>
        </div>
        <div class="row slick-product">
            <div class="col s12">
                <div id="featured-product" class="featured-product">
                    <?php foreach($cctv as $row):?>
                        <div>
                            <div class="col-slick-product">
                                <div class="box-product" onclick="location.href='<?php echo site_url('details/'.$row['slug']);?>';">
                                    <div class="bp-top">
                                        <div class="product-list-img">
                                            <div class="pli-one">
                                                <div class="pli-two"> <img src="<?php echo base_url('assets/backend/images/uploads/products/').$row['image1'];?>" alt="<?php echo $row['image1'];?>"> </div>
                                            </div>
                                        </div>
                                        <div class="item-info">
                                            <?php echo $row['product'];?>
                                        </div>
                                        <div class="price"> (UGX)
                                            <?php echo number_format($row['price']);?>
                                        </div>
                                        <div class="stock-item" onclick="location.href='<?php echo site_url('details/'.$row['slug']);?>';">VIEW DETAILS</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section promo">
    <div class="container">
        <div class="col s12 card"> <img src="<?php echo base_url('assets/frontend/img/banner.jpg');?>" alt="promo" onclick="location.href='<?php echo site_url('earn-with-us');?>';"> </div>
    </div>
</div>
<div class="section product-item fire-list-homepage">
    <div class="container">
        <div class="row row-title">
            <div class="col s12">
                <div class="section-title"> <span style="color: #fff;">FIRE SYSTEMS</span> </div>
            </div>
        </div>
        <div class="row slick-product">
            <div class="col s12">
                <div id="populer-product" class="featured-product">
                    <?php foreach($fire as $row):?>
                        <div>
                            <div class="col-slick-product">
                                <div class="box-product" onclick="location.href='<?php echo site_url('details/'.$row['slug']);?>';">
                                    <div class="bp-top">
                                        <div class="product-list-img">
                                            <div class="pli-one">
                                                <div class="pli-two"> <img src="<?php echo base_url('assets/backend/images/uploads/products/').$row['image1'];?>" alt="<?php echo $row['image1'];?>"> </div>
                                            </div>
                                        </div>
                                        <div class="item-info">
                                            <?php echo word_limiter($row['product'],3);?>
                                        </div>
                                        <div class="price"> (UGX)
                                            <?php echo number_format($row['price']);?>
                                        </div>
                                        <div class="stock-item" onclick="location.href='<?php echo site_url('details/'.$row['slug']);?>';">VIEW DETAILS</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section product-item si-featured">
    <div class="container">
        <div class="row row-title">
            <div class="col s12">
                <div class="orange-title"> BIOMETRIC SYSTEMS <span class="orange-secondary-color">SEE ALL</span> </div>
            </div>
        </div>
        <div class="row slick-product">
            <div class="col s12">
                <div id="biometric-systems" class="featured-product">
                    <?php foreach($biometrics as $row):?>
                        <div>
                            <div class="col-slick-product">
                                <div class="box-product" onclick="location.href='<?php echo site_url('details/'.$row['slug']);?>';">
                                    <div class="bp-top">
                                        <div class="product-list-img">
                                            <div class="pli-one">
                                                <div class="pli-two"> <img src="<?php echo base_url('assets/backend/images/uploads/products/').$row['image1'];?>" alt="<?php echo $row['image1'];?>"> </div>
                                            </div>
                                        </div>
                                        <div class="item-info">
                                            <?php echo $row['product'];?>
                                        </div>
                                        <div class="price"> (UGX)
                                            <?php echo number_format($row['price']);?>
                                        </div>
                                        <div class="stock-item" onclick="location.href='<?php echo site_url('details/'.$row['slug']);?>';">VIEW DETAILS</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section product-item si-featured">
    <div class="container">
        <div class="row row-title">
            <div class="col s12">
                <div class="orange-title"> ALARM SYSTEMS <span class="orange-secondary-color">SEE ALL</span> </div>
            </div>
        </div>
        <div class="row slick-product">
            <div class="col s12">
                <div id="alarm-systems" class="featured-product">
                    <?php foreach($alarms as $row):?>
                        <div>
                            <div class="col-slick-product">
                                <div class="box-product" onclick="location.href='<?php echo site_url('details/'.$row['slug']);?>';">
                                    <div class="bp-top">
                                        <div class="product-list-img">
                                            <div class="pli-one">
                                                <div class="pli-two"> <img src="<?php echo base_url('assets/backend/images/uploads/products/').$row['image1'];?>" alt="<?php echo $row['image1'];?>"> </div>
                                            </div>
                                        </div>
                                        <div class="item-info">
                                            <?php echo $row['product'];?>
                                        </div>
                                        <div class="price"> (UGX)
                                            <?php echo number_format($row['price']);?>
                                        </div>
                                        <div class="stock-item" onclick="location.href='<?php echo site_url('details/'.$row['slug']);?>';">VIEW DETAILS</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section ">
    <div class="container">
        <div class="row">
            <div class="col s6 card"> <img src="<?php echo base_url('assets/frontend/img/ad3.jpg');?>"> </div>
            <div class="col s6 card"> <img src="<?php echo base_url('assets/frontend/img/ad4.jpg');?>"> </div>
        </div>
    </div>
</div>
<div class="section product-item si-featured">
    <div class="container">
        <div class="row row-title">
            <div class="col s12">
                <div class="orange-title"> Telephone Systems <span class="orange-secondary-color">SEE ALL</span> </div>
            </div>
        </div>
        <div class="row slick-product">
            <div class="col s12">
                <div id="engineering-tools" class="featured-product">
                    <?php foreach($telephone as $row):?>
                        <div>
                            <div class="col-slick-product">
                                <div class="box-product" onclick="location.href='<?php echo site_url('details/'.$row['slug']);?>';">
                                    <div class="bp-top">
                                        <div class="product-list-img">
                                            <div class="pli-one">
                                                <div class="pli-two"> <img src="<?php echo base_url('assets/backend/images/uploads/products/').$row['image1'];?>" alt="<?php echo $row['image1'];?>"> </div>
                                            </div>
                                        </div>
                                        <div class="item-info">
                                            <?php echo word_limiter($row['product'], 3);?>
                                        </div>
                                        <div class="price"> (UGX)
                                            <?php echo number_format($row['price']);?>
                                        </div>
                                        <div class="stock-item" onclick="location.href='<?php echo site_url('details/'.$row['slug']);?>';">VIEW DETAILS</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section testimonial">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="black-title"> LATEST NEWS </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="main-slider" data-indicators="true">
                    <div class="carousel carousel-slider " data-indicators="true"> <a class="carousel-item"><img src="<?php echo base_url('assets/frontend/img/slider1.jpg');?>" alt="slider"></a> <a class="carousel-item"><img src="<?php echo base_url('assets/frontend/img/slider2.jpg');?>" alt="slider"></a> <a class="carousel-item"><img src="<?php echo base_url('assets/frontend/img/slider3.jpg');?>" alt="slider"></a> <a class="carousel-item"><img src="<?php echo base_url('assets/frontend/img/slider4.jpg');?>" alt="slider"></a> <a class="carousel-item"><img src="<?php echo base_url('assets/frontend/img/slider5.jpg');?>" alt="slider"></a> <a class="carousel-item"><img src="<?php echo base_url('assets/frontend/img/slider6.jpg');?>" alt="slider"></a> </div>
                </div>
            </div>
        </div>
    </div>
</div>

