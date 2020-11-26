<script>
$(function(){
  $("#customer_name").autocomplete({
    source: "get_customers"
  });
});
</script>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel">Add Storage Items</h4>
</div>
<div class="modal-body wrap-modal wrap" style="max-height: 900px;">
<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->


<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
               <!--  <div class="box-header box-header-background with-border">
                    <div class="col-md-offset-3">
                        <h3 class="box-title ">Add New Storage</h3>
                    </div>
                </div> -->
                <!-- /.box-header -->
                <div class="box-background">
                    <!-- form start -->
                    <form role="form" enctype="multipart/form-data" id="addStorageForm" action="<?php echo base_url(); ?>admin/storage/save_storage/" method="post">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                <div class="box-body">
                                    
                                    <div class="form-group col-md-6">
                                        <label>Product Code</label>
                                        <input type="text"  placeholder="Product Code"
                                               value="<?php echo $code ?>" class="form-control" disabled>
                                    </div>

                                    <!-- /.Product Name -->
                                    <div class="form-group col-md-6">
                                        <label>Product Name <span class="required">*</span></label>
                                        <input type="text" placeholder="Product Name" name="product_name" class="form-control">
                                    </div>

                                        <!-- /.Product Calibre -->
                                        <div class="form-group col-md-6">
                                            <label>Calibre</label>
                                            <input type="text" placeholder="Calibre" name="product_calibre" class="form-control">
                                        </div>

                                        <!-- /.Product Serial -->
                                        <div class="form-group col-md-6">
                                            <label>Serial No.</label>
                                            <input type="text" placeholder="Serial No" name="product_serial" class="form-control">
                                        </div>

                                        <!-- /.Category -->
                                        <div class="form-group col-md-4">
                                            <label>Product Category</label>
                                            <select name="category_id" class="form-control col-sm-5" id="category" onchange="get_category(this.value)">
                                                <option value="">Select Product Category</option>
                                                <?php if (!empty($category)): ?>
                                                    <?php foreach ($category as $v_category) : ?>
                                                        <option value="<?php echo $v_category->category_id; ?>">
                                                            <?php echo $v_category->category_name; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>

                                        <!-- /.Sub Category -->
                                        <div class="form-group col-md-4">
                                            <label>Subcategory<span class="required">*</span></label>
                                            <select name="subcategory_id" class="form-control col-sm-5" id="subcategory">
                                                <option value="">Product Subcategory</option>
                                                <?php if (!empty($subcategory)): ?>
                                                    <?php foreach ($subcategory as $v_subcategogy) : ?>
                                                        <option value="<?php echo $v_subcategogy->subcategory_id; ?>">
                                                            <?php echo $v_subcategogy->subcategory_name; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>

                                        <!-- /.Product Quantity -->
                                        <div class="form-group col-md-4">
                                            <label>Product Quantity </label>
                                            <input type="text" id="product_quantity" name="product_quantity" placeholder="Quantity" class="form-control">
                                        </div>


                                    <!-- ************* hidden input field ******** -->
                                    <!-- product code -->
                                    <?php if (empty($storage_info->storage_id)) {?>
                                    <input type="hidden" name="product_code"
                                           value="<?php echo $code ?>">
                                    <?php } else {  ?>
                                    <input type="hidden" name="product_code"
                                           value="<?php echo $storage_info->product_code ?>">
                                    <?php } ?>

                                    <?php if (empty($storage_info->storage_id)) {?>
                                    <input type="hidden" name="start_date"
                                           value="<?php echo date("Y/m/d"); ?>">
                                    <?php } else {  ?>
                                    <input type="hidden" name="start_date"
                                           value="<?php echo $storage_info->start_date ?>">
                                    <?php } ?>

                                    <?php if (empty($storage_info->storage_id)) {?>
                                    <input type="hidden" name="storage_number"
                                           value="<?php echo $code1 ?>">
                                    <?php } else {  ?>
                                    <input type="hidden" name="storage_number"
                                           value="<?php echo $storage_info->storage_number ?>">
                                    <?php } ?>

                                    <?php if (empty($storage_info->storage_id)) {?>
                                    <input type="hidden" name="storage_by"
                                           value="<?php echo $this->session->userdata('name'); ?>">
                                    <?php } else {  ?>
                                    <input type="hidden" name="storage_by"
                                           value="<?php echo $storage_info->storage_by ?>">
                                    <?php } ?>
                                    <br>
                                    <br>
                                    <button type="submit"  id="submit" class="btn bg-navy col-md-4 col-md-offset-4" type="submit">Save Item
                                    </button>

                                    <br/><br/>
                                </div>
                                <!-- /.box-body -->

                            </div>
                        </div>

                    </form>
                </div>
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>




</div>


