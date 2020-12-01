<?php
$CI =& get_instance();
$part_info = $CI->get_part_info($order_parts->part_id);

?>

<style>
	* {
		margin: 0
	}
</style>
<?php $CI =& get_instance(); ?>
<div class="box">
	<div class="box-header box-header-background with-border">
		<!--  <h4 class="box-title">Print Job</h4> -->
		<div class="box-tools pull-right">

		</div><!-- /.box-tools -->
	</div><!-- /.box-header -->
	<div class="box-body">


		<div id="printableArea">


			<div class="row ">
				<div class="col-md-12">
					<table width="170" cellpadding="2" border="1">
						<tbody>
						<tr>
							<td colspan="3" valign="top" align="left">Job No:<br>
								<h5><?php if (!empty($order_parts->id)) {
										echo $order_parts->id;
									} else {
										echo "N/A";
									} ?></h5>
							</td>
							<td colspan="3" valign="top" align="left">Customer:<br>
								<h5><?php if (!empty($orders->customer_id)) {
										echo $CI->get_customer_name($orders->customer_id);
									} else {
										echo "N/A";
									} ?></h5>
							</td>
						</tr>
						<tr>
							<td colspan="6" valign="top" align="left">Due Date:<br>
								<h5><?php if (!empty($orders->DueDeliveryDate)) {
										echo $orders->DueDeliveryDate;
									} else {
										echo "N/A";
									} ?></h5>
							</td>
						</tr>
						<tr>
							<td colspan="6">
								Operations
							</td>
						</tr>
						<tr>
							<td colspan="6" align="left">
								<h5><?php if(!empty($part_info->OperationF1)){echo $part_info->OperationF1;} else { echo '<br>'; }?></h5>
							</td>
						</tr>
						<tr>
							<td colspan="6" align="left">
								<h5><?php if(!empty($part_info->OperationF2)){echo $part_info->OperationF2;} else { echo '<br>'; }?></h5>
							</td>
						</tr>
						<tr>
							<td colspan="6" align="left">
								<h5><?php if(!empty($part_info->OperationF3)){echo $part_info->OperationF3;} else { echo '<br>'; }?></h5>
							</td>
						</tr>
						<tr>
							<td colspan="6" align="left">
								<h5><?php if(!empty($part_info->OperationF4)){echo $part_info->OperationF4;} else { echo '<br>'; }?></h5>
							</td>
						</tr>
						<tr>
							<td colspan="6" align="left">
								<h5><?php if(!empty($part_info->OperationF5)){echo $part_info->OperationF5;} else { echo '<br>'; }?></h5>
							</td>
						</tr>
						<tr>
							<td colspan="6" align="left">
								<h5><?php if(!empty($part_info->OperationF6)){echo $part_info->OperationF6;} else { echo '<br>'; }?></h5>
							</td>
						</tr>
						<tr>
							<td colspan="6" align="left">
								<h5><?php if(!empty($part_info->OperationF7)){echo $part_info->OperationF7;} else { echo '<br>'; }?></h5>
							</td>
						</tr>
						<tr>
							<td colspan="6" align="left">
								<h5><?php if(!empty($part_info->OperationF8)){echo $part_info->OperationF8;} else { echo '<br>'; }?></h5>
							</td>
						</tr>
						<tr>
							<td colspan="6" align="left">
								<h5><?php if(!empty($part_info->OperationF9)){echo $part_info->OperationF9;} else { echo '<br>'; }?></h5>
							</td>
						</tr>
						<tr>
							<td colspan="6" align="left">
								<h5><?php if(!empty($part_info->OperationF10)){echo $part_info->OperationF10;} else { echo '<br>'; }?></h5>
							</td>
						</tr>
						<tr>
							<td colspan="3" valign="top" align="left">
								Quantity:<br>
								<h5><?php if(!empty($order_parts->quantity)) { echo $order_parts->quantity; } else { echo "N/A"; } ?></h5>
							</td>
							<td colspan="3" valign="top" align="left">Part #:<br>
								<h5><?php if(!empty($part_info->PartNo)) { echo $part_info->PartNo; } else { echo "N/A"; } ?></h5>
							</td>
						</tr>
						<tr>
							<td colspan="6">
								Issue:<br>
								<h5><?php if(!empty($part_info->Issue)) { echo $part_info->Issue;} ?></h5>
							</td>
						</tr>
						<tr>
							<td colspan="6" align="left">
								Description:
								<h5><?php if (!empty($part_info->Description)) {
										echo $part_info->Description;
									} else {
										echo "N/A";
									} ?></h5>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div><!-- /.box-body -->
</div><!-- /.box -->


<script>
	window.print();
</script>



