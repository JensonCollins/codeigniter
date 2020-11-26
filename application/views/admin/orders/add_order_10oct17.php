<!-- View message -->
<?php echo message_box('success'); ?>
<?php echo message_box('error');?>
<style type="text/css">
#deceased{
    background-color:#FFF3F5;
	margin-bottom:15px;
}
</style>
<?php if (!empty($orders->order_id)) {
				$title = 'Edit Order';
				}else { $title = 'New Order'; } ?>
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">
                    <div class="col-md-12">
                        <h3 class="box-title "><?php echo $title; ?></h3>
                    </div>
                </div>
                <!-- /.box-header -->

				<div class="panel-body">
				<form role="form" enctype="multipart/form-data" id="addOrdersForm"
                      action="<?php echo base_url(); ?>admin/orders/save_orders/<?php if (!empty($orders->order_id)) {
                          echo $orders->order_id;
                      } ?>"
                      method="post">
				<div class="col-md-12 col-sm-12">
				    <div class = "form-group col-md-6 col-sm-6">
				     <label for="exampleInputEmail1">Order # <span class="required">*</span></label>   
						<input type="text" name="OrderNo" placeholder="Order Number"
						value="<?php
						if (!empty($orders->OrderNo)) {
						echo $orders->OrderNo;
						}
						?>"
						class="form-control">
				    </div>

				    <div class = "form-group col-md-6 col-sm-6">
						<label for="customer_id">Add Customer</label><a href="javascript:;" onclick="clearSelection('customer_id');" style="font-weight:normal;margin-left:5px;">Clear All</a>
						<select class="form-control select2" id="customer_id" name="customer_id" style="width: 100%;">
						<option value="">Select Customer</option>
						<?php
						foreach ($customers as $pc_qt_value) 
						{
						if($orders->customer_id == $pc_qt_value->customer_id)
						{
							$pc_qt_selected = 'selected=""';
						}
						else
						{
							$pc_qt_selected = '';
						}

						echo "<option id='".$pc_qt_value->customer_id."' value='".$pc_qt_value->customer_id."' ".$pc_qt_selected.">".$pc_qt_value->LongName.' ('.$pc_qt_value->ShortName.') '."</option>";
						}
						?>
						</select>
				    </div>
				</div>  

				<div class="col-md-12 col-sm-12">
				    <div class = "form-group col-md-6 col-sm-6">
				     <label for="exampleInputEmail1">Date In <span class="required">*</span></label>
						<div class="input-group">
						<input class="form-control datepicker" name="DateIn" placeholder="Date In" data-format="dd-mm-yyyy" type="text" value="<?php
						if (!empty($orders->DateIn)) {
						echo $orders->DateIn;
						}
						?>">

						<div class="input-group-addon">
						<a href="#"><i class="entypo-calendar"></i></a>
						</div>
						</div>
				    </div>

				    <div class = "form-group col-md-6 col-sm-6">
						<label for="exampleInputEmail1">Delivery Due<span class="required">*</span></label>
						<div class="input-group">
						<input class="form-control datepicker" name="DueDeliveryDate" placeholder="Due Delivery Date" data-format="dd-mm-yyyy" type="text" value="<?php
						if (!empty($orders->DueDeliveryDate)) {
						echo $orders->DueDeliveryDate;
						}
						?>">

						<div class="input-group-addon">
						<a href="#"><i class="entypo-calendar"></i></a>
						</div>
						</div>
				    </div>
				</div>

				<!-- <div class="col-md-12 col-sm-12">
				    <div class = "form-group col-md-6 col-sm-6">
						<label for="exampleInputEmail1">Order Notes</label>
						<textarea name="Notes" class="form-control autogrow" id="ck_editor" placeholder="Order Notes"><?php
						if (!empty($orders->Notes)) {
						    echo $orders->Notes;
						}
						?></textarea>
						<?php echo display_ckeditor($editor['ckeditor']); ?>
				    </div>
				</div> -->

				<?php  if (!empty($orders->order_id)) { $counter = 1; 
					if (!empty($order_parts)): foreach ($order_parts as $part) : ?>
					<div id="deceased_<?php echo $part->id;?>">
					<input type="hidden" name="order_part_id[]" value="<?php echo $part->id ?>">
					<div class="add-parts-clone">
					<div class="col-md-12 col-sm-12">
					    <div class = "form-group col-md-6 col-sm-6">
							<label for="sel_parts">Parts</label><a href="javascript:;" onclick="clearSelection('sel_parts_<?php echo $part->part_id;?>');" style="font-weight:normal;margin-left:5px;">Clear All</a>
							<select class="form-control select2" id="sel_parts_<?php echo $part->part_id;?>" name="sel_parts[]" style="width: 100%;">
							<option value="">Select Parts</option>
							<?php 
							foreach ($parts as $pc_qt_value) 
							{   //print_r($pc_qt_value);
							if($part->part_id == $pc_qt_value->id)
							{
								$pc_qt_selected = 'selected=""';
							}
							else
							{
								$pc_qt_selected = '';
							}

							echo "<option id='".$pc_qt_value->id."' value='".$pc_qt_value->id."' ".$pc_qt_selected.">".$pc_qt_value->Description.' ('.$pc_qt_value->PartNo.') '."</option>";
							}
							?>
							</select>
					    </div>

					    <div class = "form-group col-md-3 col-sm-3">
					     <label for="part_qty">Quantitiy # <span class="required">*</span></label>   
							<input type="text" name="part_qty[]" placeholder="Enter Quantity" value="<?php
						if (!empty($part->quantity)) {
						echo $part->quantity;
						}
						?>"
							class="form-control">
					    </div>
							
					    <!-- <div class = "form-group col-md-3 col-sm-3">
					     <label for="part_qty">Status: <span class="required">*</span></label>  
							<select class="form-control input-sm" name="mode_payment[]" id="mode_payment">
								<option value="">-- Select Status --</option>
								<option value="Pending" <?php if($part->Status == 'Pending') { echo 'selected'; } else { echo ''; } ?>>Pending</option>
								<option value="On Hold" <?php if($part->Status == 'On Hold') { echo 'selected'; } else { echo ''; } ?>>On Hold</option>
								<option value="Invoiced" <?php if($part->Status == 'Invoiced') { echo 'selected'; } else { echo ''; } ?>>Invoiced</option>
								<option value="Complete" <?php if($part->Status == 'Complete') { echo 'selected'; } else { echo ''; } ?>>Complete</option>
								<option value="Cancelled" <?php if($part->Status == 'Cancelled') { echo 'selected'; } else { echo ''; } ?>>Cancelled</option>
							</select>
					    </div> -->
					</div> 
					

					<div class="col-md-12 col-sm-12">
						<!-- <div class = "form-group col-md-3 col-sm-3">
					     <label for="part_qty">Job Notes:<span class="required">*</span></label>   
							<textarea name="job_notes[]" class="form-control autogrow" id="ck_editor" placeholder="job Notes"><?php
							if (!empty($part->Notes)) {
							    echo $part->Notes;
							}
							?></textarea>
							<?php //echo display_ckeditor($editor['ckeditor']); ?>
					    </div> -->

						<div class = "form-group col-md-3 col-sm-3">
					     <label for="mat_supplier">Mat Supplier<span class="required">*</span></label>   
							<input type="text" name="mat_supplier[]" placeholder="Enter Mat Supplier" value=""
							class="form-control">
					    </div>


						<div class = "form-group col-md-3 col-sm-3">
					     <label for="mat_cost">Mat Cost <span class="required">*</span></label>   
							<input type="text" name="mat_cost[]" placeholder="Enter Mat Cost" value=""
							class="form-control">
					    </div>

						<div class = "form-group col-md-3 col-sm-3">
					     <label for="order_price">Order Price<span class="required">*</span></label>   
							<input type="text" name="order_price[]" placeholder="Enter Order Price" value="<?php
						if (!empty($part->OrderPrice)) {
						echo $part->OrderPrice;
						}
						?>"
							class="form-control">
					    </div>

					</div>
					</div>
					</div>
					<?php $counter++; endforeach; ?>
					<?php else : ?> <!--get error message if this empty-->
					<td colspan="6">
					<strong>There is no record for display</strong>
					</td><!--/ get error message if this empty-->
					<?php endif; ?>
				<?php } else { ?>

				<div id="deceased">
				<div class="add-parts-clone">
				<div class="col-md-12 col-sm-12">
				    <div class = "form-group col-md-3 col-sm-3">
						<label for="sel_parts">Parts</label><a href="javascript:;" onclick="clearSelection('sel_parts');" style="font-weight:normal;margin-left:5px;">Clear All</a>
						<select class="form-control select2" id="sel_parts" name="sel_parts[]" style="width: 100%;">
						<option value="">Select Parts</option>
						<?php 
						foreach ($parts as $pc_qt_value) 
						{   //print_r($pc_qt_value);
						if($orders->Customer == $pc_qt_value->id)
						{
							$pc_qt_selected = 'selected=""';
						}
						else
						{
							$pc_qt_selected = '';
						}

						echo "<option id='".$pc_qt_value->id."' value='".$pc_qt_value->id."' ".$pc_qt_selected.">".$pc_qt_value->Description.' ('.$pc_qt_value->PartNo.') '."</option>";
						}
						?>
						</select>
				    </div>

				    <div class = "form-group col-md-2 col-sm-2">
				     <label for="part_qty">Quantitiy # <span class="required">*</span></label>   
						<input type="text" name="part_qty[]" placeholder="Enter Quantity" value=""
						class="form-control">
				    </div>

				    <!-- <div class = "form-group col-md-3 col-sm-3">
				     <label for="part_qty">Status: <span class="required">*</span></label>  
						<select class="form-control input-sm" name="mode_payment[]" id="mode_payment">
							<option value="">-- Select Status --</option>
							<option value="Pending">Pending</option>
							<option value="On Hold">On Hold</option>
							<option value="Invoiced">Invoiced</option>
							<option value="Complete">Complete</option>
							<option value="Cancelled">Cancelled</option>
						</select>
				    </div> -->
				<!-- </div>  -->
				

				<!-- <div class="col-md-12 col-sm-12"> -->
					<!-- <div class = "form-group col-md-3 col-sm-3">
				     <label for="part_qty">Job Notes:<span class="required">*</span></label>   
						<textarea name="job_notes[]" class="form-control autogrow" id="ck_editor" placeholder="job Notes"><?php
						if (!empty($orders->Notes)) {
						    echo $orders->Notes;
						}
						?></textarea>
						<?php //echo display_ckeditor($editor['ckeditor']); ?>
				    </div> -->

					<div class = "form-group col-md-2 col-sm-2">
				     <label for="mat_supplier">Mat Supplier<span class="required">*</span></label>   
						<input type="text" name="mat_supplier[]" placeholder="Enter Mat Supplier" value=""
						class="form-control">
				    </div>


					<div class = "form-group col-md-2 col-sm-2">
				     <label for="mat_cost">Mat Cost <span class="required">*</span></label>   
						<input type="text" name="mat_cost[]" placeholder="Enter Mat Cost" value=""
						class="form-control">
				    </div>

					<div class = "form-group col-md-2 col-sm-2">
				     <label for="order_price">Order Price<span class="required">*</span></label>   
						<input type="text" name="order_price[]" placeholder="Enter Order Price" value=""
						class="form-control">
				    </div>

				</div>
				</div>
				</div>

				<div class="col-md-12 col-sm-12" id="addblock">
				<div class="form-group col-md-3 col-sm-3">
				<button class="btn btn-success btn-add btn-xs" type="button" id="add_parts"><span class="glyphicon glyphicon-plus" style="font-family: Helvetica,Arial,sans-serif;">&nbsp;Add More Parts</span></button>
				</div>
				</div>

				<?php } ?>

				<!-- <div class="form-group col-md-3 col-sm-3"> -->
				<!-- <button class="btn btn-success btn-add" type="submit">Save</button> -->
				<!-- <button type="submit" id="btn_order" class="btn bg-navy btn-block ">Save Order</button>
				</div> -->
						<!-- order id -->
				<input type="hidden" name="id" value="<?php if (!empty($orders->order_id)) {
				echo $orders->order_id;
				$btn = 'Update Order';
				}else { $btn = 'Save Order'; } ?>" id="id">

				<div class="btn bg-navy col-md-offset-10">
				<!-- <button type="submit" id="customer_btn" class="btn bg-navy col-md-offset-3" type="submit">Create Parts
				</button> -->
				<button type="submit" id="btn_order" class="btn bg-navy btn-block "><?php echo  $btn ; ?></button>
				</div>
				</form>
				</div>
            <!-- /.box -->
        </div>
        <!--/.col end -->
    </div>
	</div>
    <!-- /.row -->
</section>

<script src="<?php echo base_url() ?>asset/js/ajax.js" ></script>