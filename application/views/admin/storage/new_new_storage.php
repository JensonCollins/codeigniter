<script src="<?php echo base_url(); ?>asset/js/tag-it.js" type="text/javascript" charset="utf-8"></script>
<link href="<?php echo base_url(); ?>asset/css/jquery.tagit.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>asset/js/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>asset/js/ajax.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>asset/js/bootstrap-notify.js"></script>
<link href="<?php echo base_url(); ?>asset/css/animate.css" rel="stylesheet" type="text/css" />

<script>
$(function(){
  $("#customer_name").autocomplete({
    source: "get_customers"
  });
});
</script>

<script>
$(function() {
	$("#end_date").change(function () {
		var end_date = $("#end_date").val();
		var start_date = $("#start_date").val();
		//var storage_days = 
		var d1 = $('#end_date').datepicker('getDate');
		var d2 = $('#start_date').datepicker('getDate');
		var oneDay = 24*60*60*1000;
		var diff = 0;
		var total_cost = 0;
		if (d1 && d2) {
			diff = Math.round(Math.abs((d2.getTime() - d1.getTime())/(oneDay)));
		}

    	$('#storage_days').val(diff);

    	var cost_per_day = $("#cost_per_day").val();
    	//alert(cost_per_day);
    	//var arr = cost_per_day.split(' ');
    	//alert(arr[1]);
    	
    	var total_cost = parseInt(diff) * parseInt(cost_per_day);

    	//alert(total_cost);
    	//$('#total_cost').val(total_cost);
    	//$('input[name=total_cost]').val(total_cost);
    	//alert(total_cost);
    	$('#total_cost').attr('value', total_cost)

    	//var dddd = $("#total_cost").val();
		//alert(dddd);
	});
});

</script>

<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->
<?php $cart = $this->cart->contents() ;?>



<section class="content">
<div class="row">
    <div class="col-sm-12">

        <div class="box box-primary">
            <div class="box-header box-header-background with-border">
                <h3 class="box-title ">New Storage</h3>
            </div>
            <div class="box-body">


                <div class="row">
                    <div class="col-md-8 col-sm-12">

                        <div class="box  box-warning">
                            <div class="box-header box-header-background-light with-border">
                                <h3 class="box-title ">Add Items To Storage</h3>
                            </div>


                            <div class="box-body order-panel">

<!--                                 <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                                    <li class="active"><a href="#product-list" data-toggle="tab">Shopping Cart</a>
                                    </li>
                                    <li><a href="#search-product" data-toggle="tab">Search Product</a></li>
                                </ul>
 -->

                                <div id="my-tab-content" class="tab-content">

                                    <!-- ***************  Cart Tab Start ****************** -->
                                    <div class="tab-pane active" id="product-list">


                                        <div class="row">

                                            <div class="col-md-5">

                                                <form method="post" action="<?php echo base_url(); ?>admin/order/add_cart_item_by_barcode">
                                                    <div class="input-group">
                                                          <span class="input-group-btn">
                                                            <!-- <button type="submit" class="btn bg-blue" type="button">Add -->
                                                            <?php //echo btn_view_modal('admin/storage/add_storage/'); ?> <!-- Products</button> -->
                                                            <a data-target="#myModal" title="Add Item" data-placement="top" data-toggle="modal" class="btn bg-olive btn-xs" href="<?php echo base_url(); ?>admin/storage/add_storage"><span class="glyphicon glyphicon-plus"></span></a>
                                                          </span>
                                                    </div>
                                                </form>
                                                <!-- /input-group -->
                                            </div>
                                            <!-- /.col-lg-6 -->
                                        </div>

                                        <br/>
                                        <div id="cart_content">
											<table class="table table-bordered table-hover">
											    <thead ><!-- Table head -->
											    <tr>
											        <th class="active">Sl</th>
											        <th class="active">Product</th>
											        <th class="active ">Category</th>
											        <th class="active ">Calibre</th>
											        <th class="active">Qty</th>
											        <th class="active">Action</th>
											    </tr>
											    </thead><!-- / Table head -->
											    <tbody><!-- / Table body -->
											    <?php //print_r($storage);
											    ?>
											    <?php $counter =1 ; $storage_items_id = array();?>
											    <?php if (!empty($storage)): foreach ($storage as $item) : ?>
											        <tr class="custom-tr">
											            <td class="vertical-td">
											                <?php echo  $counter ?>
											            </td>
											            <td class="vertical-td"><?php echo ucfirst($item->product_name); ?></td>
											            <td class="vertical-td"><?php echo $item->category_name .' > '. $item->subcategory_name; ?></td>
											            <td class="vertical-td"><?php echo $item->product_calibre; ?></td>
											            <td class="vertical-td"><?php echo $item->product_quantity; ?></td>
															<td class="vertical-td">
															<?php echo btn_view_modal('admin/storage/view_storage/' . $item->storage_id); ?>
															<?php echo btn_delete('admin/storage/delete_storage/' . $item->storage_id); ?>
														</td>
											        </tr>
											        <?php
											        $storage_items_id[] = $item;
											        $counter++;
											    endforeach;
											        ?><!--get all sub category if not this empty-->

											    <?php else : ?> <!--get error message if this empty-->
											        <td colspan="6">
											            <strong>There is no record for display</strong>
											        </td><!--/ get error message if this empty-->
											    <?php endif; ?>
											    </tbody><!-- / Table body -->
											</table> <!-- / Table -->
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!--/.col end -->

                    <div class="col-md-4 col-sm-12">
                    		<form method="post" action="<?php echo base_url(); ?>admin/storage/save_order_storage">
                            <div class="box">
                                <div class="box-header with-border box-header-background">
                                    <h3 class="box-title ">Summary</h3><?php //print_r($storage_items_id); ?>
                                </div>

                                <div id="cart_summary">
									<div class="box-background">
									   <div class="box-body">
									       <div class="row">
									           <div class="col-md-12">

									               <div class="form-group">
									                   <label class="col-sm-5 control-label">Storage No</label>
									                   <div class="col-sm-7">
									                       <input type="text" value="<?php echo $code1; ?>" disabled class="form-control ">
									                   </div>
									               </div>
									           </div>
									       </div>
									   </div>
									</div>

									<div class="box-body">

									<div class="row">

									<div class="col-md-12">

                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Acquisition No </label>
                                        <div class="col-sm-12">
                                            <input type="text" placeholder="E.g. A102" name="acquisition" class="form-control txt-auto" id="acquisition">
                                        </div>
                                    </div>


                                    <!--Storage By field is hidden-->
                                    <div class="form-group">
                                    <!-- <label class="col-sm-6 control-label">Storage By</label> -->
                                    <div class="col-sm-12">
                                    <input type="hidden" name="storage_by" value="<?php echo $this->session->userdata('name'); ?>" readonly="readonly" class="form-control ">
                                    </div>
                                    </div>

                                    <div class="form-group">
                                    <label class="col-sm-6 control-label">Customer Name </label>
                                    <div class="col-sm-12">
                                    <input type="text" placeholder="Search Customer Name" name="customer_name"
                                               class="form-control txt-auto" id="customer_name">
                                    </div>
                                    </div>

                                    <div class="form-group">
                                    <label class="col-sm-6 control-label">Storage State</label>
                                    <div class="col-sm-12">
                                        <select name="status" class="form-control">
                                            <option value="">Select Storage State</option>
                                            <option value="1">In Storage</option>
                                            <option value="2">Collected</option>
                                        </select>
                                    </div>
                                    </div>

                                    <div class="form-group">
                                    <label class="col-sm-6 control-label">Start Date</label>
                                    <div style="margin: 15px;" class="input-group col-sm-11">
                                     <input type="text" value="<?php echo date("Y/m/d"); ?>" class="form-control datepicker" name="start_date" id="start_date" data-format="yyyy/mm/dd" disabled>

                                            <div class="input-group-addon">
                                                <a href="#"><i class="entypo-calendar"></i></a>
                                            </div>
                                    </div>
                                    </div>

                                    <div class="form-group">
                                    <label class="col-sm-6 control-label">End Date</label>
                                    <div style="margin: 15px;" class="input-group col-sm-11">
                                      <input type="text" class="form-control datepicker" id="end_date" name="end_date" data-format="yyyy/mm/dd" required>
										<div class="input-group-addon">
										    <a href="#"><i class="entypo-calendar"></i></a>
										</div>
                                    </div>
                                    </div>


                                    <!-- <div class="form-group">
                                    <label class="col-sm-6 control-label">Customer Name </label>
                                    <div class="col-sm-12">
                                    <input type="text" placeholder="Search Customer Name" name="customer_name"
                                               class="form-control txt-auto" id="customer_name">
                                    </div> -->
                                    <!-- </div> --><!-- <br><br><br><br> -->

									<div class="box-background" id="order">
									    <div class="box-body">
									        <div class="row">
									            <div class="col-md-12">
									               <div class="form-group">
									                    <label class="col-sm-5 control-label">Storage Days</label>
									                    <div class="col-sm-7">
									                        <input type="text" value="" id="storage_days" name="storage_days" class="form-control unite" style="background-color: #cacbc5;color: #000;font-size: 18px;font-style: unset;font-weight: bold;" readonly="readonly">
									                    </div>
									                </div>
									            </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-5 control-label">Cost Per Day</label>
                                                        <div class="col-sm-7">
                                                            <!-- <span class="input-group-addon">$</span> -->
                                                            <input type="text" value="12" id="cost_per_day" name="cost_per_day" class="form-control unite" style="background-color: #cacbc5;color: #000;font-size: 18px;font-style: unset;font-weight: bold;" readonly="readonly">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-5 control-label">Total Cost</label>

                                                        <div class="col-sm-7">
                                                            <input type="text" id="total_cost" name="total_cost"  class="form-control unite" style="background-color: #cacbc5;color: #000;font-size: 18px;font-style: unset;font-weight: bold;" value="0" readonly="readonly">
                                                        </div>
                                                    </div>
                                                </div>
									        </div>
									    </div>
									</div>
                                    </br>
                                    </br>
									<button type="submit" id="btn_order" class="btn bg-navy btn-block " type="submit" <?php echo !empty($storage)?'':'disabled' ?>>Submit Storage Order
									</button>
									<input type="hidden" value="<?php echo date("Y/m/d"); ?>" name="start_date">
									<input type="hidden" value="<?php echo $code1; ?>" name="storage_number">
									<input type="hidden" value="<?php echo $this->session->userdata('name'); ?>" name="storage_by">
									<input type='hidden'  name='storage_item_ids' value='<?php echo serialize($storage_items_id); ?>'>
									</form>
									</div>
									</div>
									</div>

                                </div>
                            </div>
                            <!-- /.box -->
                    </div>
                    <!--/.col end -->



                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->
    </div>
    <!--/.col end -->
</div>
<!-- /.row -->
</section>


<script>

    $().ready(function() {
        // validate signup form on keyup and submit
        $("#newform").validate({
            rules: {
                product_name: "required",
                qty: "required",

                product_name: {
                    required: true
                },
                qty: {
                    required: true,
                    number: true
                },

                price: {
                    required: true,
                    number: true

                }

            },
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {

                product_name: {
                    required: "Please enter Product Name"
                }



            }

        });

    });
</script>

<?php
$cart_msg = $this->session->flashdata('cart_msg');
if( !empty($cart_msg))
{ ?>
<script>

    $.notify({
        // options
        <?php if($cart_msg == 'add'){ ?>
        icon: 'glyphicon glyphicon-ok-sign',
        message: '  Product add to cart successfully!'
        <?php }else{ ?>
        icon: 'glyphicon glyphicon-ok-sign',
        message: '  Delete from cart successfully!'
        <?php } ?>
    },{
        // settings
        element: 'body',
        position: null,
        <?php if($cart_msg == 'add'){ ?>
        type: "info",
        <?php }else{ ?>
        type: "danger",
        <?php } ?>
        allow_dismiss: true,
        newest_on_top: false,
        showProgressbar: false,
        placement: {
            from: "top",
            align: "right"
        },
        offset: 60,
        spacing: 10,
        z_index: 1031,
        delay: 5000,
        timer: 1000,
        mouse_over: null,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        },
        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: 'class',
        template: '<div data-notify="container" class="col-xs-11 col-sm-2 alert alert-{0}" role="alert">' +
        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
        '<span data-notify="icon"></span> ' +
        '<span data-notify="title">{1}</span> ' +
        '<span data-notify="message">{2}</span>' +
        '<div class="progress" data-notify="progressbar">' +
        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
        '</div>' +
        '<a href="{3}" target="{4}" data-notify="url"></a>' +
        '</div>'
    });

</script>
<?php } ?>

