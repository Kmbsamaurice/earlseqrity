<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('admin/index');?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
        <div class="container py-4 my-2">
    <div class="row">
        <div class="col-md-4 pr-md-5">
            <img class="w-100 rounded border" src="<?php echo base_url('assets/backend/images/uploads/admins/').$user['image'];?>" />
            <div class="pt-4 mt-2">
            </div>
        </div>
        <div class="col-md-8">
            <div class="d-flex align-items-center">
                <h2 class="font-weight-bold m-0">
                  <?php echo $user['email'];?>
                </h2>
                <address class="m-0 pt-2 pl-0 pl-md-4 font-weight-light text-secondary">
                    <i class="fa fa-map-marker"></i>
                    Kampala, UGANDA
                </address>
            </div>
            <p class="h5 text-primary mt-2 d-block font-weight-light">
                Administrator
            </p>
            <p class="lead mt-4">As an Administrator you can make changes to the website.</p>
            <section class="mt-5">
                <h3 class="h6 font-weight-light text-priamry text-uppercase">Username</h3>
                <div class="d-flex align-items-center">
                    <strong class="h5 font-weight-bold m-0 mr-3"><?php echo $user['username'];?></strong>
                    <div>
                        <input data-filled="fa fa-2x fa-star mr-1 text-warning" data-empty="fa fa-2x fa-star-o mr-1 text-light" value="5" type="hidden" class="rating" data-readonly />
                    </div>
                </div>
            </section>
            <section class=" mt-5">
                <a href="<?php echo base_url('admin/profile/edit');?>" title="edit profile" class="btn btn-outline-info mr-2"><i class="fa fa-pencil"></i>EDIT PROFILE </a>
            </section>
        </div>
    </div>
</div> 