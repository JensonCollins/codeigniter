<?php
$CI =& get_instance();
$part_info = $CI->get_part_info($order_parts->part_id);

?>
<?php $CI =& get_instance(); ?>
<style>
    * {
        margin: 0
    }
</style>
<div class="box">
    <div class="box-header box-header-background with-border">
    </div><!-- /.box-header -->
    <div class="box-body">


        <div id="printableArea">


            <div class="row ">
                <div class="col-md-12">
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
                                            <h3><?php if (!empty($order_parts->id)) {
                                                    echo $order_parts->id;
                                                } else {
                                                    echo "N/A";
                                                } ?></h3>
                                        </td>
                                        <td colspan="5" valign="top" align="center">Description:<br>
                                            <h3><?php if (!empty($part_info->Description)) {
                                                    echo $part_info->Description;
                                                } else {
                                                    echo "N/A";
                                                } ?></h3>
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
                                            <h3><?php if (!empty($order_parts->quantity)) {
                                                    echo $order_parts->quantity;
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

                </div>
            </div>
        </div>
    </div><!-- /.box-body -->
</div><!-- /.box -->


<script>
    window.print();
</script>

