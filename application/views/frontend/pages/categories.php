<!-- CONTENT -->
<div id="page-content">
  <div class="categorylist-page">
    <div class="container">
      <div class="box-category-list">
        <?php foreach($catinfo as $row): ?>
        <!-- item -->
        <div class="row category-item" onclick="location.href='<?php echo site_url('category/'.$row['slug']);?>';">
          <div class="col s12">
            <div class="category-box">
              <div class="cat-img">
                <div class="cat-img-product">
                    <img src="<?php echo base_url('assets/backend/images/uploads/icons/').$row['icon'];?>" alt="category-icon">
                </div>
              </div>
              <div class="cat-name">
                <div class="cat-top">
                  <div class="catg-title"><?php echo $row['category']; ?></div>
                  <!--div-- class="catg-number">600 Products</!--div-->
                  <div class="cat-info"><?php echo $row['tagline']; ?></div>
                </div>
              </div>
              <div class="cat-more">
                <a href="<?php echo site_url('category/'.$row['slug']);?>"><i class="fas fa-angle-right"></i></a>
              </div>
              <div style="clear: both"></div>
            </div>
          </div>
        </div>
        <!-- end item -->
      <?php endforeach;?>
      </div>
    </div>
  </div>
</div>
<!-- END CONTENT -->