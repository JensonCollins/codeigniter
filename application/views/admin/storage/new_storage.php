<script src="<?php echo base_url(); ?>asset/js/tag-it.js" type="text/javascript" charset="utf-8"></script>
<link href="<?php echo base_url(); ?>asset/css/jquery.tagit.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="<?php echo base_url(); ?>asset/js/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>asset/js/ajax.js" type="text/javascript" charset="utf-8"></script>

<script>
$(function(){
  $("#customer_name").autocomplete({
    source: "get_customers"
  });
});
// AJAX call for autocomplete 
// $(document).ready(function(){
// 	$("#customer_name").keyup(function(){
// 		$.ajax({
// 		type: "POST",
// 		url: "get_customers",
// 		data:'term='+$(this).val(),
// 		beforeSend: function(){
// 			$("#customer_name").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
// 		},
// 		success: function(data){
// 			alert(data);
// 			$("#suggesstion-box").show();
// 			$("#suggesstion-box").html(data);
// 			$("#search-box").css("background","#FFF");
// 		}
// 		});
// 	});
// });
// //To select country name
// function selectCountry(val) {
// $("#customer_name").val(val);
// $("#suggesstion-box").hide();
// }
</script>
<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->


<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">
                    <div class="col-md-offset-3">
                        <h3 class="box-title ">Add New Storage</h3>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-background">
                    <!-- form start -->
                    <form role="form" enctype="multipart/form-data" id="addStorageForm" action="<?php echo base_url(); ?>admin/storage/save_storage/<?php  if (!empty($storage_info)) {
                          echo $storage_info->storage_id;
                      } ?>" method="post">

                        <div class="row">

                            <div class="col-md-4 col-sm-12 col-xs-12 col-md-offset-3">

                                <div class="box-body">
                                	<!-- /.Start Date -->
                                    <div class="form-group">
                                        <label class="control-label">Start Date<span class="required"> *</span></label>

                                        <div class="input-group">
                                           

                                            <input type="text" value="<?php
                                                if (!empty($storage_info)) {
                                                    $start_date = date('Y/m/d', strtotime($storage_info->start_date));
                                                    echo $start_date;
                                                }
                                                else{
                                                    echo date("Y/m/d");
                                                }
                                                ?>" class="form-control datepicker" name="start_date" data-format="yyyy/mm/dd" disabled>

                                            <div class="input-group-addon">
                                                <a href="#"><i class="entypo-calendar"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- /.End Date -->
                                    <div class="form-group">
                                        <label class="control-label">End Date<span class="required"> *</span></label>
                                        <div class="input-group">
                                            <input type="text" value="<?php
                                                if (!empty($storage_info)) {
                                                    $end_date = date('Y/m/d', strtotime($storage_info->end_date));
                                                    echo $end_date;
                                                }
                                                ?>" class="form-control datepicker" name="end_date" data-format="yyyy/mm/dd" required>

                                            <div class="input-group-addon">
                                                <a href="#"><i class="entypo-calendar"></i></a>
                                            </div>
                                        </div>
                                    </div>

									<!-- /.Product Code -->
									<?php if (!empty($storage_info->storage_id)) {?>
									<div class="form-group">
									    <label>Product Code</label>
									    <input type="text"  placeholder="Product Code"
									           value="<?php echo $storage_info->product_code ?>"
									           class="form-control" disabled>
									</div>
									<?php }else { ?>

									    <div class="form-group">
									        <label>Product Code</label>
									        <input type="text"  placeholder="Product Code"
									               value="<?php echo $code ?>"
									               class="form-control" disabled>
									    </div>

									<?php } ?>

									<!-- /.Product Name -->
									<div class="form-group">
									    <label>Product Name <span class="required">*</span></label>
									    <input type="text" placeholder="Product Name" name="product_name"
									           value="<?php
									           if (!empty($storage_info)) {
									               echo $storage_info->product_name;
									           }
									           ?>"
									           class="form-control">
									</div>

										<!-- /.Product Size -->
                                        <div class="form-group">
                                            <label>Product Size <span class="required">*</span></label>
                                            <input type="text" placeholder="Product Size" name="product_size"
                                                   value="<?php
                                                   if (!empty($storage_info)) {
                                                       echo $storage_info->product_size;
                                                   }
                                                   ?>"
                                                   class="form-control">
                                        </div>

										<!-- /.Product Quantity -->
										<div class="form-group">
										    <label>Product Quantity </label>
										    <input type="text" id="product_quantity" name="product_quantity" placeholder="Quantity"
										           value="<?php
										           if (!empty($storage_info)) {
										               echo $storage_info->product_quantity;
										           }
										           ?>"
										           class="form-control">
										</div>


                                        <!-- /.Category -->
                                        <div class="form-group">
                                            <label>Product Category</label>
                                            <select name="category_id" class="form-control col-sm-5" id="category" onchange="get_category(this.value)">
                                                <option value="">Select Product Category</option>
                                                <?php if (!empty($category)): ?>
                                                    <?php foreach ($category as $v_category) : ?>
                                                        <option value="<?php echo $v_category->category_id; ?>"
                                                            <?php
                                                            if (!empty($storage_info)) {
                                                                echo $v_category->category_id == $product_category->category_id ? 'selected' : '';
                                                            }
                                                            ?> >
                                                            <?php echo $v_category->category_name; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>

                                        <!-- /.Sub Category -->
                                        <div class="form-group">
                                            <label>Subcategory<span class="required">*</span></label>
                                            <select name="subcategory_id" class="form-control col-sm-5" id="subcategory">
                                                <option value="">Product Subcategory</option>
                                                <?php if (!empty($subcategory)): ?>
                                                    <?php foreach ($subcategory as $v_subcategogy) : ?>
                                                        <option value="<?php echo $v_subcategogy->subcategory_id; ?>"
                                                            <?php
                                                            if (!empty($storage_info)) {
                                                                echo $v_subcategogy->subcategory_id == $storage_info->subcategory_id ? 'selected' : '';
                                                            }
                                                            ?> >
                                                            <?php echo $v_subcategogy->subcategory_name; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>

									<!-- /.Customer Name -->
									<div class="form-group">
									    <label>Customer Name <span class="required">*</span></label>
									    <input type="text" placeholder="Search Customer Name" name="customer_name"
									           value="<?php
									           if (!empty($storage_info)) {
									               echo $storage_info->customer_name;
									           }
									           ?>"
									           class="form-control txt-auto" id="customer_name">
									           <div id="suggesstion-box"></div>
									</div>

									<!-- /.Storage Number -->
                                    <?php if (!empty($storage_info->storage_id)) {?>
									<div class="form-group">
									    <label>Storage Number <span class="required">*</span></label>
									    <input type="text" placeholder="Storage Number" name="storage_number"
									           value="<?php
									           if (!empty($storage_info)) {
									               echo $storage_info->storage_number;
									           }
									           ?>"
									           class="form-control" disabled>
									</div>
                                    <?php }else { ?>

                                        <div class="form-group">
                                            <label>Storage Number</label>
                                            <input type="text"  placeholder="Storage Number"
                                                   value="<?php echo $code1 ?>"
                                                   class="form-control" disabled>
                                        </div>

                                    <?php } ?>

									<!-- /.Storage By -->
                                    <?php if (!empty($storage_info->storage_id)) {?>
									<div class="form-group">
									    <label>Storage By <span class="required">*</span></label>
									    <input type="text" placeholder="Storage By" name="storage_by"
									           value="<?php
									           if (!empty($storage_info)) {
									               echo $storage_info->storage_by;
									           }
									           ?>"
									           class="form-control" disabled>
									</div>
                                    <?php }else { ?>

                                        <div class="form-group">
                                            <label>Storage By</label>
                                            <input type="text"  placeholder="Storage By"
                                                   value="<?php echo $this->session->userdata('name'); ?>"
                                                   class="form-control" disabled>
                                        </div>

                                    <?php } ?>

									<!-- /.Storage State-->
	                                <div class="form-group">
	                                    <label for="exampleInputEmail1">Storage State</label>
	                                    <select name="status" class="form-control">
	                                        <option value="">Select Storage State</option>
	                                        <option value="1" <?php
                                                            if (!empty($storage_info)) {
                                                                echo $storage_info->status == '1' ? 'selected' : '';
                                                            }
                                                            ?>>In Storage</option>
	                                        <option value="2" <?php
                                                            if (!empty($storage_info)) {
                                                                echo $storage_info->status == '2' ? 'selected' : '';
                                                            }
                                                            ?>>Collected</option>
	                                    </select>
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
									<button type="submit"  id="submit" class="btn bg-navy col-md-offset-3" type="submit">Save Storage
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


