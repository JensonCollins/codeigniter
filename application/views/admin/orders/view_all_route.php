<?php
$CI =& get_instance();
?>
<style type="text/css">
table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px;
}

table th,
table td {
    padding: 5px;
    background: #EEEEEE;
    text-align: center;
    border-bottom: 1px solid #000000;
}

table th {
    white-space: nowrap;
    font-weight: normal;
}

table td {
    text-align: right;
}

table td h3{
    color: #000000;
    font-size: 14px;
    font-weight: bold;
    margin: 0 0 0.2em 0;
}

table .no {
    color: #000;
    font-size: 1.6em;
    background: #C4CBC2;
}

table .desc {
    text-align: left;
}

table .unit {
    background: #DDDDDD;
}

table .qty {
}

table .total {
    background: #DDD;
    color: #000;
}

table td.unit,
table td.qty,
table td.total {
    font-size: 1.2em;
}

table tbody tr:last-child td {
    border: none;
}

table tfoot td {
    padding: 10px 20px;
    background: #oooooo;
    border-bottom: none;
    font-size: 1.2em;
    white-space: nowrap;
    border-top: 1px solid #AAAAAA;
}

table tfoot tr:first-child td {
    border-top: none;
}

table tfoot tr:last-child td {
    color: #57B223;
    font-size: 1.4em;
    border-top: 1px solid #57B223;

}

table tfoot tr td:first-child {
    border: none;
}
</style>
<?php $CI =& get_instance();?>
<div class="box">
    <div class="box-header box-header-background with-border">
        <h3 class="box-title">View Route</h3>
        <div class="box-tools pull-right">
            <!-- Buttons, labels, and many other things can be placed here! -->
            <!-- Here is a label for example -->
            <div class="box-tools">
                <div class="btn-group" role="group" >
                    <a onclick="print_invoice('printableArea')" class="btn btn-default" target = "_blank">Print</a>

                </div>
            </div>

        </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">


        <div id="printableArea">

            <?php foreach($order_parts as $v_order):  $part_info = $CI->get_part_info($v_order->part_id);?>
            <div class="row ">
            	<div class="col-md-12">
					<table width="1100" cellpadding="2" border="1" height="600">
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
            </div>
        	</div>
            <?php endforeach; ?>
        </div>
    </div><!-- /.box-body -->
</div><!-- /.box -->





