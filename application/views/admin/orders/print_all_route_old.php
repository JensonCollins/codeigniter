<?php
$CI =& get_instance();
?>
<?php $CI =& get_instance();?>
 <!-- <link href="<?php echo base_url(); ?>asset/css/bootstrap.css" rel="stylesheet" type="text/css" /> -->
<style type='text/css'>
	*{margin:0}
	@media print {
		table {page-break-inside:avoid; page-break-after:auto}
	}
</style>
<div class="box">
    <div class="box-header box-header-background with-border">
    </div><!-- /.box-header -->
    <div class="box-body">


        <div id="printableArea">

            <?php foreach($order_parts as $v_order):  $part_info = $CI->get_part_info($v_order->part_id);?>
					<table width="100%" cellpadding="2" border="1" height="600">
					<tbody><tr>
					<td colspan="6" align="center"><b>Bedford Engineering - Route Card</b></td>
					</tr>
					<tr>


					<td valign="top" align="left">Job No:<br>
					<h3><?php if(!empty($v_order->id)) { echo $v_order->id;} else { echo "N/A"; } ?></h3>
					</td>
					<td colspan="5" valign="top" align="left">Description:<br>
					<h3><?php if(!empty($part_info->Description)) { echo $part_info->Description;} else { echo "N/A"; } ?></h3>
					</td>
					</tr>
					<tr>
					<td valign="top" align="left">Customer:<br>
					<h3><?php if(!empty($orders->customer_id)) { echo $CI->get_customer_name($orders->customer_id);} else { echo "N/A"; }  ?></h3>
					</td>
					<td valign="top" align="left">Order No:<br>
					<h3><?php if(!empty($orders->OrderNo)) { echo $orders->OrderNo; } else { echo "N/A"; } ?></h3>
					</td>
					<td colspan="3" valign="top" align="left">Drg No (Part #):<br>
					<h3><?php if(!empty($part_info->PartNo)) { echo $part_info->PartNo;} else { echo "N/A"; } ?></h3>
					</td>
					<td valign="top" align="left">Quantity:<br>
					<h3><?php if(!empty($v_order->quantity)) { echo $v_order->quantity; } else { echo "N/A"; } ?></h3></td>
					</tr>
					<tr>
					<td valign="top" align="left">Date In:<br>
					<h3><?php if(!empty($orders->DateIn)) { echo $orders->DateIn; } else { echo "N/A"; } ?></h3>
					</td>
					<td valign="top" align="left">Delivery Due:<br>
					<h3><?php if(!empty($orders->DueDeliveryDate)) {  echo $orders->DueDeliveryDate; } else { echo "N/A"; } ?></h3>
					</td>
					<td colspan="3" valign="top" align="left">Part Delivery:<br>
					</td>
					<td valign="top" align="left">Issue:<br>
					<h3><?php if(!empty($part_info->Issue)) { echo $part_info->Issue;  } else { echo "N/A"; }?></h3></td>
					</tr>
					<tr>
					<td colspan="12" style="font-size:6em;line-height:100%;text-align: center;" align="center" height="70%">Route
					Card</td>
					</tr>

					</tbody></table>
            <?php endforeach; ?>
        </div>
    </div><!-- /.box-body -->
</div><!-- /.box -->


<script>
    window.print();
</script>


