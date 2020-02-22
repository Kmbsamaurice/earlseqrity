<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('admin/index');?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Add Subcategory</li>
        </ol>
        <?php echo $this->session->flashdata('message');?>
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-body">
          <?php echo form_open_multipart('admin/subcategory/add');?>
            <div class="form-row">
               
               <div class="form-group col-md-12">
               <label>subcategory <span class="text-danger">*</span> </label>
                  <input type="text" class="form-control" name="subcategory" id="subcategory" placeholder="subcategory" value="<?php echo set_value('subcategory');?>">
                  <span class="text-danger"><?php echo form_error('subcategory');?></span>
               </div>
               <div class="form-group col-md-12">
               <label>Category <span class="text-danger">*</span> </label>
               <select name="category" id="catid" class="form-control input-subcategory-catid" >
               <option value="<?php echo set_value('category');?>">
               <?php 
                  if(set_value('category')){
                    echo set_value('category');
                  }else{
                    echo "choose a category";
                  }          
                ?>            
                </option>
                    <?php foreach($catinfo as $cat):?>
                    <option value="<?php echo $cat['catid'];?>">
                       <?php echo $cat['category']; ?>
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