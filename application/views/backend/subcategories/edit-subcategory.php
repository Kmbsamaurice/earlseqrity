<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('admin/index');?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Edit <?php echo $subcategory['subcategory'];?></li>
        </ol>
        <?php echo $this->session->flashdata('message');?>
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-body">
          <?php echo form_open_multipart('admin/subcategory/'.$subcategory["slug"]);?>
            
            <div class="form-row">
            
               <div class="form-group col-md-12">
               <input type="hidden" name="subid" value="<?php echo $subcategory["subid"];?>">
                  <label>subcategory <span class="text-danger">*</span> </label>
                  <input type="text" class="form-control" name="subcategory" id="subcategory" placeholder="subcategory" value="<?php echo $subcategory['subcategory'];?>">
                  <span class="text-danger"><?php echo form_error('subcategory');?></span>
               </div>
               <div class="form-group col-md-12">
               <label>Category <span class="text-danger">*</span> </label>
               <select name="catid" id="catid" class="form-control input-subcategory-catid" >
                    <option value="<?php  echo $catinfo['catid'];?>">
                       <?php echo $catinfo['category']; ?>
                    </option>  
                  <?php foreach($sub as $cat):?>
                        <option value="<?php  echo $cat['catid'];?>">
                            <?php  echo $cat['category'];?>
                        </option>
                    <?php endforeach;?>
                </select>
               <span class="text-danger"><?php echo form_error('category');?></span>   
               </div>    
               <div class="col-md-12 col-sm-12s field">
                        <button type="submit" class="btn btn-primary mr-2">Save</button>
                        <a class="btn btn-light" href="<?php echo base_url('admin/subcategories');?>">Cancel</a>
                  </div>
               </div>
               </form>
               </div>
            </div>
          </div>
        </div>
      </div>      
      <!-- /.container-fluid -->