<?php
$CI =& get_instance();
$part_info = $CI->get_part_info($order_parts->part_id);

?>

<style>
	* {
		margin: 0
	}
	h6 {
		font-size: 0.7em;
	}
	h5 {
		font-size: 0.7em;
	}
</style>
<style type="text/css" media="print">
	@page {
		size: auto;   /* auto is the initial value */
		margin: 0;  /* this affects the margin in the printer settings */
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
							<td colspan="3" valign="top" align="left">
								<h6><?php if (!empty($order_parts->id)) {
										echo $order_parts->id;
									}?></h6>
							</td>
							<td colspan="3" valign="top" align="left">
								<h6><?php if (!empty($orders->customer_id)) {
										echo $CI->get_customer_short_name($orders->customer_id);
									}?></h6>
							</td>
						</tr>
						<tr>
							<td colspan="6" valign="top" align="left">
								<div class="d-flex">
									<h5>Due Date:
										<?php if (!empty($orders->DueDeliveryDate)) {
											echo $orders->DueDeliveryDate;
										}?></h5>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="6">
								<h5>Operations</h5>
							</td>
						</tr>
						<tr>
							<td colspan="6" align="left">
								<h6><?php if(!empty($part_info->OperationF1)){echo $part_info->OperationF1;} else { echo '<br>'; }?></h6>
							</td>
						</tr>
						<tr>
							<td colspan="6" align="left">
								<h6><?php if(!empty($part_info->OperationF2)){echo $part_info->OperationF2;} else { echo '<br>'; }?></h6>
							</td>
						</tr>
						<tr>
							<td colspan="6" align="left">
								<h6><?php if(!empty($part_info->OperationF3)){echo $part_info->OperationF3;} else { echo '<br>'; }?></h6>
							</td>
						</tr>
						<tr>
							<td colspan="6" align="left">
								<h6><?php if(!empty($part_info->OperationF4)){echo $part_info->OperationF4;} else { echo '<br>'; }?></h6>
							</td>
						</tr>
						<tr>
							<td colspan="6" align="left">
								<h6><?php if(!empty($part_info->OperationF5)){echo $part_info->OperationF5;} else { echo '<br>'; }?></h6>
							</td>
						</tr>
						<tr>
							<td colspan="6" align="left">
								<h6><?php if(!empty($part_info->OperationF6)){echo $part_info->OperationF6;} else { echo '<br>'; }?></h6>
							</td>
						</tr>
						<tr>
							<td colspan="6" align="left">
								<h6><?php if(!empty($part_info->OperationF7)){echo $part_info->OperationF7;} else { echo '<br>'; }?></h6>
							</td>
						</tr>
						<tr>
							<td colspan="6" align="left">
								<h6><?php if(!empty($part_info->OperationF8)){echo $part_info->OperationF8;} else { echo '<br>'; }?></h6>
							</td>
						</tr>
						<tr>
							<td colspan="3" valign="top" align="left">
								<h5>Qty: <?php if(!empty($order_parts->quantity)) { echo $order_parts->quantity; }?></h5>
							</td>
							<td colspan="3">
								<h5>Issue: <?php if(!empty($part_info->Issue)) { echo $part_info->Issue;} ?></h5>
							</td>
						</tr>
						<tr>
							<td colspan="6" valign="top" align="left">
								<h5>Part #: <?php if(!empty($part_info->PartNo)) { echo $part_info->PartNo; }?></h5>
							</td>
						</tr>
						<tr>
							<td colspan="6" align="left">
								<h5>Description:</h5>
								<h6><?php if (!empty($part_info->Description)) {
										echo $part_info->Description;
									}?></h6>
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



