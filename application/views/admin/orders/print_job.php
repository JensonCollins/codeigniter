<?php
$CI =& get_instance();
$part_info = $CI->get_part_info($order_parts->part_id);

?>

<style>
	*{
		margin:0
	}
</style>
<?php $CI =& get_instance();?>
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
				<table width="1100" cellpadding="2" border="1">

				<tbody><tr><td colspan="5" width="50%" valign="top" align="right"><b></b></td>
				<td></td>
				<td colspan="6" align="left"><b>Bedford Engineering - Job Card</b></td>
				</tr><tr>
				<td rowspan="5" colspan="5" valign="top" align="left">
				Notes:
				<h4><?php if(!empty($part_info->Notes)) { echo $part_info->Notes; } ?></h4>
				</td>
				<td rowspan="21" valign="top" align="left">__</td>
				<td valign="top" align="left">Job No:
				<h4><?php if(!empty($order_parts->id)) { echo $order_parts->id;} else { echo "N/A"; }  ?></h4>
				</td>
				<td colspan="5" valign="top" align="left">Description:<br>
				<h4><?php if(!empty($part_info->Description)) { echo $part_info->Description;} else { echo "N/A"; }  ?></h4>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left">Customer:<br>
				<h4><?php if(!empty($orders->customer_id)) { echo $CI->get_customer_short_name($orders->customer_id);} else { echo "N/A"; }  ?></h4>
				</td>
				<td valign="top" align="left">Order No:<br>
				<h4> <?php if(!empty($orders->OrderNo)) { echo $orders->OrderNo;} else { echo "N/A"; }  ?></h4>
				</td>
				<td colspan="3" valign="top" align="left">Drg No (Part #):<br>
				<h4><?php if(!empty($part_info->PartNo)) { echo $part_info->PartNo; } else { echo "N/A"; } ?></h4>
				</td>
				<td valign="top" align="left">Quantity:<br>
				<h4><?php if(!empty($order_parts->quantity)) { echo $order_parts->quantity; } else { echo "N/A"; } ?></h4></td>
				</tr>
				<tr>
				<td valign="top" align="left">Date In:<br>
				<h4><?php if(!empty($orders->DateIn)) { echo $orders->DateIn;} else { echo "N/A"; }  ?></h4>
				</td>
				<td valign="top" align="left">Delivery Due:<br>
				<h4><?php if(!empty($orders->DueDeliveryDate)) { echo $orders->DueDeliveryDate;} else { echo "N/A"; }  ?></h4>
				</td>
				<td colspan="3" valign="top" align="left">Part Delivery:<br>
				</td>
				<td valign="top" align="left">Issue:<br>
				<h4><?php if(!empty($part_info->Issue)) { echo $part_info->Issue;} ?></h4></td>
				<!--<h4><?php if(!empty($part_info->Issue)) { echo $part_info->Issue;} else { echo "N/A"; }  ?></h4></td>-->
				</tr>
				<tr>
				<td rowspan="5" colspan="6" valign="middle" align="left"><h5>Account Use Only<br>
				Inv #: ........................................Date:..........................<br>
				Delivery Note #: ..........................Date:..........................</h5></td>
				</tr>
				<tr>
				</tr>
				<tr>
				<td rowspan="2" colspan="2" valign="top" align="left">Material #:<br>
				</td>
				<td rowspan="2" valign="top" align="left">Material PO #:<br>
				<br></td>
				<td rowspan="2" colspan="2" valign="top" align="left">Test Cert:<br>
				</td>
				</tr>
				<tr>

				</tr>
				<tr>
				<td valign="top" align="left">Material:<br>
				<h4><?php if(!empty($part_info->Material)) { echo $part_info->Material; } else { echo "N/A"; }  ?></h4></td>
				<td valign="top" align="left">Mat Supplier:<br>
				<h3><?php if(!empty($v_order->mat_supplier)) { echo $v_order->mat_supplier;} ?></h3></td>
				<td valign="top" align="left">Mat Desc:<br>
				<h3><?php if(!empty($part_info->MatDescription)) { echo $part_info->MatDescription;} else { echo "N/A"; } ?></h3></td>
				<td colspan="2" valign="top" align="left">Mat Cost:<br>
				<h3>£ <?php if(!empty($v_order->mat_cost)) { echo $v_order->mat_cost;} ?></h3></td>
				</tr>

				<tr>
				<td colspan="2" valign="top" align="left">Treatment:<br>
				<h4><?php if(!empty($part_info->Treatment)) { echo $part_info->Treatment;} ?></h4></td>
				<td valign="top" align="left">Treatment Cost:<br>
				<h4>£ <?php if(!empty($part_info->TreatmentCost)) { echo $part_info->TreatmentCost;}?></h4></td>
				<td colspan="2" valign="top" align="left">Treatment PO#:</td>
				<td colspan="2" valign="bottom" align="left">Operation</td>
				<td valign="bottom" align="left">Initials</td>
				<td valign="bottom" align="left">Accepted</td>
				<td valign="bottom" align="left">Rejected</td>
				<td width="11%" valign="bottom" align="left">Notes</td>
				</tr>
				<tr>
				<td rowspan="2" colspan="2" valign="top" align="left">Inspection:</td>
				<td rowspan="2" colspan="3" valign="top" align="left">Mat Stored:</td>
				<td colspan="2" valign="top" align="left"><h4><?php if(!empty($part_info->OperationF1)){echo $part_info->OperationF1;}?></h4></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td width="11%" valign="top" align="left"><br></td>
				</tr>

				<tr>
				<td colspan="2" valign="top" align="left"><h4><?php if(!empty($part_info->OperationF2)){echo $part_info->OperationF2;}?></h4></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td width="11%" valign="top" align="left"><br></td>
				</tr>
				<tr>
				<td colspan="2" valign="top" align="left">Quantity:</td>
				<td colspan="3">C of C:</td>
				<td colspan="2" valign="top" align="left"><h4><?php if(!empty($part_info->OperationF3)){echo $part_info->OperationF3;}?></h4></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td width="11%" valign="top" align="left"><br></td>
				</tr>
				<tr>
				<td colspan="5" valign="top" align="left"></td>
				<td colspan="2" valign="top" align="left"><h4><?php if(!empty($part_info->OperationF4)){echo $part_info->OperationF4;}?></h4></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td width="11%" valign="top" align="left"><br></td>
				</tr>
				<tr>
				<td valign="top" align="left"><br></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td colspan="2" valign="top" align="left"><h4><?php if(!empty($part_info->OperationF5)){echo $part_info->OperationF5;}?></h4></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td width="11%" valign="top" align="left"><br>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left"><br></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
                                <td colspan="2" valign="top" align="left"><h4><?php if(!empty($part_info->OperationF6)){echo $part_info->OperationF6;}?></h4></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td width="11%" valign="top" align="left"><br>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left"><br></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
                                <td colspan="2" valign="top" align="left"><h4><?php if(!empty($part_info->OperationF7)){echo $part_info->OperationF7;}?></h4></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td width="11%" valign="top" align="left"><br>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left"><br></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td rowspan="4" colspan="2" valign="top" align="left"><b>Inspection</b><br>
				Completed:<br>
				Date:<br>
				Signed:</td>
				<td rowspan="4" colspan="4" valign="top" align="left"><b>Office Use Only</b><br>
				Completed:<br>
				Date:<br>
				Delivery Note No:</td>
				</tr>
				<tr>
				<td valign="top" align="left"><br></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				</tr>
				<tr><td valign="top" align="left"><br>
				</td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				</tr><tr>
				<td valign="top" align="left"><br></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
				<td valign="top" align="left"></td>
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



