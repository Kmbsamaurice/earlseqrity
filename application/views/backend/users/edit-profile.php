<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('admin/index');?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Edit Profile</li>
        </ol>
        <?php echo $this->session->flashdata('message');?>
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-body">
          <?php echo form_open_multipart('admin/profile/edit');?>
            <div class="form-row">
               
               <div class="form-group col-md-6">
                  <label>username <span class="text-danger">*</span> </label>
                  <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $user['username'];?>">
                  <span class="text-danger"><?php echo form_error('username');?></span>
               </div>
               <div class="form-group col-md-6">
                  <label>Email Address</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="<?php echo $user['email'];?>" readonly>
               </div>
               <div class="row">
               <div class="form-group col-md-4">
                  <div class="form-group row">
                     <div class="col-sm-6">
                        <label class="col-sm-7 col-form-label">Picture</label>
                        <img src="<?php echo base_url('assets/backend/images/uploads/admins/').$user['image'];?>"  alt="image" class="profile-pic rounded-circle" width="120px">
                     </div>
                  </div>
               </div>
               <div class="form-group col-md-8">
               <div class="file-upload">
                  <div class="image-upload-wrap">
                     <input class="file-upload-input" type='file' name="image" onchange="readURL(this);" accept="image/*" />
                     <div class="drag-text">
                        <h3>Drag and drop a file or select add Image</h3>
                     </div>
                  </div>
                  <div class="file-upload-content">
                     <img class="file-upload-image" src="#" alt="your image" />
                     <div class="image-title-wrap">
                        <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                     </div>
                  </div>
                  </div>
               </div>  
               <div class="col-md-12 col-sm-12s field">
                  <button type="submit" class="btn btn-primary mr-2">Save</button>
                  <a class="btn btn-light" href="<?php echo base_url('admin/users');?>">Cancel</a>
                  </div>
               </div>
               </form>
               </div>
            </div>
          </div>
        </div>
      </div>      
      <!-- /.container-fluid -->
      <script src="">
       function readURL(input) {
         if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function(e) {
               $('.image-upload-wrap').hide();

               $('.file-upload-image').attr('src', e.target.result);
               $('.file-upload-content').show();

               $('.image-title').html(input.files[0].name);
            };

            reader.readAsDataURL(input.files[0]);

         } else {
            removeUpload();
         }
         }

         function removeUpload() {
         $('.file-upload-input').replaceWith($('.file-upload-input').clone());
         $('.file-upload-content').hide();
         $('.image-upload-wrap').show();
         }
         $('.image-upload-wrap').bind('dragover', function () {
               $('.image-upload-wrap').addClass('image-dropping');
            });
            $('.image-upload-wrap').bind('dragleave', function () {
               $('.image-upload-wrap').removeClass('image-dropping');
         });
      </script>