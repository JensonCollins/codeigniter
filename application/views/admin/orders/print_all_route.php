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
            <table cellpadding="0" border="0" width="100%">
                        <tr>
                            <td width="50%" style="border: 1px solid #000;padding: 0;"></td>
                            <td width="2%" style="border: 1px solid #000;padding: 0;"></td>
                            <td width="48%">
                                <table width="100%" cellpadding="2" border="1" height="600">
                                    <tbody>
                                    <tr>
                                        <td colspan="6" align="center"><b>Bedford Engineering - Route Card</b></td>
                                    </tr>
                                    <tr>


                                        <td valign="top" align="center">Job No:<br>
                                            <h3><?php if(!empty($v_order->id)) { echo $v_order->id;} else { echo "N/A"; } ?></h3>
                                        </td>
                                        <td colspan="5" valign="top" align="center">Description:<br>
                                            <h3><?php if(!empty($part_info->Description)) { echo $part_info->Description;} else { echo "N/A"; } ?></h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" align="center">Customer:<br>
                                            <h3><?php if(!empty($orders->customer_id)) { echo $CI->get_customer_short_name($orders->customer_id);} else {
                                                    echo "N/A";
                                                } ?></h3>
                                        </td>
                                        <td valign="top" align="center">Order No:<br>
                                            <h3><?php if (!empty($orders->OrderNo)) {
                                                    echo $orders->OrderNo;
                                                } else {
                                                    echo "N/A";
                                                } ?></h3>
                                        </td>
                                        <td colspan="3" valign="top" align="center">Drg No (Part #):<br>
                                            <h3><?php if (!empty($part_info->PartNo)) {
                                                    echo $part_info->PartNo;
                                                } else {
                                                    echo "N/A";
                                                } ?></h3>
                                        </td>
                                        <td valign="top" align="center">Quantity:<br>
                                            <h3><?php if (!empty($v_order->quantity)) {
                                                    echo $v_order->quantity;
                                                } else {
                                                    echo "N/A";
                                                } ?></h3></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" align="center">Date In:<br>
                                            <h3><?php if (!empty($orders->DateIn)) {
                                                    echo $orders->DateIn;
                                                } else {
                                                    echo "N/A";
                                                } ?></h3>
                                        </td>
                                        <td valign="top" align="center">Delivery Due:<br>
                                            <h3><?php if (!empty($orders->DueDeliveryDate)) {
                                                    echo $orders->DueDeliveryDate;
                                                } else {
                                                    echo "N/A";
                                                } ?></h3>
                                        </td>
                                        <td colspan="3" valign="top" align="center">Part Delivery:<br>
                                        </td>
                                        <td valign="top" align="center">Issue:<br>
                                            <h3><?php if (!empty($part_info->Issue)) {
                                                    echo $part_info->Issue;
                                                } else {
                                                    echo "N/A";
                                                } ?></h3></td>
                                    </tr>
                                    <tr>
                                        <td colspan="12" style="font-size:6em;line-height:100%;text-align: center;" align="center" height="70%">Route
                                            Card
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
            <?php endforeach; ?>
        </div>
    </div><!-- /.box-body -->
</div><!-- /.box -->


<script>
    window.print();
</script>


