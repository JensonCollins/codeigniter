<?php $CI =& get_instance();?>
<div class="box">
    <div class="box-body">
        <div id="printableArea" width="100%">
            <div class="row ">
            <div class="col-md-12">
                <main>
                    <div id="details" class="clearfix">
                        <table width="100%">
                            <tr>
                                <td>
                                    <div id="client">
                                        <!-- <div class="to">CUSTOMER BILLING INFO:</div> -->
                                        <!-- <h2 class="name"><?php echo $order_info->customer_name ?></h2> -->
                                        <div class="email">PO #: <?php  if(!empty($orders->OrderNo)) { echo $orders->OrderNo ; } else { echo "N/A"; }?></div>
                                        <div class="email">Date In: <?php  if(!empty($orders->DateIn)) { echo date('d.m.Y', strtotime($orders->DateIn));  } else { echo "N/A"; }?></div>
                                        <div class="email">Date Out: <?php  if(!empty($orders->DueDeliveryDate)) { echo date('d.m.Y', strtotime($orders->DueDeliveryDate));} else { echo "N/A"; } ?></div>
                                        <div class="address">Customer: <?php  if(!empty($orders->customer_id)) { echo $CI->get_customer_name($orders->customer_id); } else { echo "N/A"; } ?></div>
                                        <div class="address">Tel No: <?php  if(!empty($orders->customer_id)) { echo $CI->get_customer_phone($orders->customer_id);  } else { echo "N/A"; }?></div>
                                    </div>
                                </td>
                                <td>
                                    <div id="invoice">
                                        <h1 style="font-size: 1.8em;" align="right">Order: <?php echo $orders->order_id ?></h1>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <table border="0" cellspacing="0" cellpadding="0" width="100%" style="margin-top:50px;">
                        <thead>
                        <tr>
                            <th class="no text-right">#</th>
                            <th class="no">Job No:</th>
                            <th class="no">Part No.</th>
                            <th class="no">QTY</th>
                            <th class="no">Description</th>
                            <th class="no" align="right">Part Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $counter = 1; $total = 0;?>
                        <?php foreach($order_parts as $v_order):  $part_info = $CI->get_part_info($v_order->part_id); $total = $v_order->quantity*$part_info->Price + $total;?>
                        <tr>
                            <td class="text-right"><?php echo $counter ; ?></td>
                            <td class="desc" style="text-align: center;"><h3><?php echo $v_order->id ?></h3></td>
                            <td class="desc" style="text-align: center;"><?php if(!empty($part_info->PartNo)) { echo $part_info->PartNo ; } else { echo "N/A"; }?></td>
                            <td class="desc" style="text-align: center;"><?php if(!empty($v_order->quantity)) { echo $v_order->quantity  ; } else { echo "N/A"; } ?></td>
                            <td class="desc" style="text-align: center;"><?php if(!empty($part_info->Description)) { echo $part_info->Description ; } else { echo "N/A"; }?></td>
                            <td class="total" style="text-align: right;"><?php if(!empty($part_info->Price)) { echo $part_info->Price ; } else { echo "N/A"; }?></td>

			</tr>
                            <?php $counter ++?>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>

                        <tr>
                            <td colspan="1"></td><td colspan="1"></td><td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="1" style="font-weight: bold">Order TOTAL</td><td></td>
                            <td class="qty text-center" style="font-weight: bold" align="right"><?php echo '£ '.number_format($total, 2); ?></td>
                        </tr>
                        </tfoot>
                    </table>

                </main>
            </div>
        </div>
            </div>


    </div><!-- /.box-body -->
</div><!-- /.box -->

<script>
    window.print();
</script>


