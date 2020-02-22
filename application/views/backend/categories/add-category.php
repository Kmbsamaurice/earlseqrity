<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('admin/index');?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Add Category</li>
        </ol>
        <?php echo $this->session->flashdata('message');?>
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-body">
          <?php echo form_open_multipart('admin/category/add');?>
            <div class="form-row">
               
               <div class="form-group col-md-6">
                  <label>category <span class="text-danger">*</span> </label>
                  <input type="text" class="form-control" name="category" id="category" placeholder="Category" value="<?php echo set_value('category');?>">
                  <span class="text-danger"><?php echo form_error('category');?></span>
               </div>
               <div class="form-group col-md-6">
                  <label>Tagline <span class="text-danger">*</span> </label>
                  <input type="text" class="form-control" name="tagline" id="tagline" placeholder="Tagline" value="<?php echo set_value('tagline');?>">
                  <span class="text-danger"><?php echo form_error('tagline');?></span>
               </div>
               <div class="form-group col-md-12">
                  <label>Icon <span class="text-danger">*</span> </label>
                  <div class="file-upload">
                  <div class="image-upload-wrap">
                     <input class="file-upload-input" type='file' name="userfile" onchange="readURL(this);" accept="image/*" required/>
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
                  <a class="btn btn-light" href="<?php echo base_url('admin/categories');?>">Cancel</a>
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