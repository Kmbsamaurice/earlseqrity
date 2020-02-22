<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('admin/index');?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Add Product</li>
        </ol>
        <?php echo $this->session->flashdata('message');?>
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-body">
          <?php echo form_open_multipart('admin/product/add');?>
            <div class="form-row">
               
               <div class="form-group col-md-4">
                  <input type="text" class="form-control" name="product" id="product" placeholder="Product *" value="<?php echo set_value('product');?>">
                  <span class="text-danger"><?php echo form_error('product');?></span>
               </div>
               <div class="form-group col-md-4">
                  <select name="subid" id="subid" class="form-control" >
                    <option value="">choose subcategory *</option>
                    <?php foreach($subinfo as $sub):?>
                        <option value="<?php  echo $sub['subid'];?>">
                            <?php echo $sub['subcategory']; ?>
                        </option>
                    <?php endforeach;?>    
                    </select>
                <span class="text-danger"><?php echo form_error('subid');?></span>
               </div>
               <div class="form-group col-md-4">
                  <select name="catid" id="catid" class="form-control" >
                        <option value="">choose category *</option>
                    <?php foreach($catinfo as $cat):?>
                        <option value="<?php  echo $cat['catid'];?>">
                    <?php echo $cat['category']; ?>
                        </option>
                    <?php endforeach;?>    
                </select>
                <span class="text-danger"><?php echo form_error('catid');?></span>
               </div>
               <div class="form-group col-md-6">
                  <select name="brandid" id="catid" class="form-control">
                    <option value="">choose brand *</option>
                    <?php foreach($brandinfo as $brand):?>
                    <option value="<?php  echo $brand['brandid'];?>">
                        <?php echo $brand['brand']; ?>
                    </option>
                    <?php endforeach; ?>
                    </select>
                <span class="text-danger"><?php echo form_error('brandid');?></span>
               </div>
               <div class="form-group col-md-6">
                    <input type="text" class="form-control" placeholder="Product price *" name="price" value="<?php echo set_value('price');?>">
                    <span class="text-danger"><?php echo form_error('price');?></span>
               </div>
               <div class="form-group col-md-6">
                  <input type="text" class="form-control" placeholder="Product new price *" name="new_price" value="<?php echo set_value('new_price');?>">
                <span class="text-danger"><?php echo form_error('new_price');?></span>
               </div>
               <div class="form-group col-md-6">
                  <input type="text" class="form-control" placeholder="Available quantity *" name="quantity" value="<?php echo set_value('quantity');?>">
                <span class="text-danger"><?php echo form_error('quantity');?></span>
               </div>
               <div class="form-group col-md-4">
                  <div class="file-upload">
                  <div class="image-upload-wrap">
                     <input class="file-upload-input" type='file' name="userfile" onchange="readURL(this);" accept="image/*" required/>
                     <div class="drag-text">
                        <h3>add Image one*</h3>
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
               <div class="form-group col-md-4">
                  <div class="file-upload">
                  <div class="image-upload-wrap">
                     <input class="file-upload-input" type='file' name="userfile1" onchange="readURL(this);" accept="image/*" required/>
                     <div class="drag-text">
                     <h3>add Image two*</h3>
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
               <div class="form-group col-md-4">
                  <div class="file-upload">
                  <div class="image-upload-wrap">
                     <input class="file-upload-input" type='file' name="userfile2" onchange="readURL(this);" accept="image/*" required/>
                     <div class="drag-text">
                        <h3>add Image three*</h3>
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
               <div class="form-group col-md-12">
                <label for="details">Product description <span class="text-danger">*</span></label>
                <textarea name="description" id="description" cols="30" rows="10" class="ckeditor form-control"><?php echo set_value("description");?></textarea>
                <span class="text-danger"><?php echo form_error('description');?></span>
                </div>    
               <div class="col-md-12 col-sm-12s field">
                  <button type="submit" class="btn btn-primary mr-2">Save</button>
                  <a class="btn btn-light" href="<?php echo base_url('admin/products');?>">Cancel</a>
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
      <script type="text/javascript" src="<?php echo base_url('assets/backend/');?>ckeditor/ckeditor.js"></script>
