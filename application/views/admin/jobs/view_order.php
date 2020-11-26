<?php $CI =& get_instance();?>
<div class="box">
    <div class="box-header box-header-background with-border">
        <h3 class="box-title">View Order</h3>
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
            <link href="<?php echo base_url(); ?>asset/css/invoice.css" rel="stylesheet" type="text/css" />



            <div class="row ">


            <div class="col-md-12">

                <main>
                    <div id="details" class="clearfix">
                        <div id="client" style="margin-right: 100px">
                            <!-- <div class="to">CUSTOMER BILLING INFO:</div> -->
                            <!-- <h2 class="name"><?php echo $order_info->customer_name ?></h2> -->
                            <div class="email">PO #: <?php echo $orders->OrderNo ?></div>
                            <div class="email">Date In: <?php echo date('Y-m-d', strtotime($orders->DateIn)); ?></div>
                            <div class="email">Date Out: <?php echo date('Y-m-d', strtotime($orders->DueDeliveryDate)); ?></div>
                            <div class="address">Customer: <?php echo $CI->get_customer_name($orders->customer_id); ?></div>
                            <div class="address">Tel No: <?php echo $CI->get_customer_phone($orders->customer_id); ?></div>
                        </div>


                        <div id="invoice">
                            <h1 style="font-size: 1.8em;">Order: <?php echo $orders->order_id ?></h1>
                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th class="no text-right">#</th>
                            <th class="no">Job No:</th>
                            <th class="no">Part No.</th>
                            <th class="no">QTY</th>
                            <th class="no">Description</th>
                            <th class="no">Price</th>
                            <th class="no">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $counter = 1; $total = 0;?>
                        <?php foreach($order_parts as $v_order):  $part_info = $CI->get_part_info($v_order->part_id); $total = $v_order->OrderPrice + $total;?>
                        <tr>
                            <td class="text-right"><?php echo $counter ; ?></td>
                            <td class="desc" style="text-align: center;"><h3><?php echo $v_order->id ?></h3></td>
                            <td class="desc" style="text-align: center;"><?php if(!empty($part_info->PartNo)) { echo $part_info->PartNo ; } else { echo "N/A"; }?></td>
                            <td class="desc" style="text-align: center;"><?php if(!empty($v_order->quantity)) { echo $v_order->quantity  ; } else { echo "N/A"; } ?></td>
                            <td class="desc" style="text-align: center;"><?php if(!empty($part_info->Description)) { echo $part_info->Description ; } else { echo "N/A"; }?></td>
                            <td class="total" style="text-align: center;"><?php if(!empty($v_order->OrderPrice)) { echo $v_order->OrderPrice ; } else { echo "N/A"; }?></td>
                            <td class="vertical-td hide-print">
                                    <a href="<?php echo base_url('admin/orders/view_job/'.$orders->order_id.'/'.$v_order->id ) ?>" target = "_blank" class="btn btn-xs btn-primary" title="" data-toggle="tooltip" data-placement="top" data-original-title="View Job">Job</a> | 
                                    <a href="<?php echo base_url('admin/orders/print_job/'.$orders->order_id.'/'.$v_order->id ) ?>" target="_blank"  class="btn btn-xs btn-primary" title="" data-toggle="tooltip" data-placement="top" data-original-title="Print Job">Print Job</a> | 
                                    <a href="<?php echo base_url('admin/orders/print_all_job/'.$orders->order_id) ?>" target = "_blank" class="btn btn-xs btn-primary" title="" data-toggle="tooltip" data-placement="top" data-original-title="Print All Jobs">Print All Jobs</a> | 
                                    <a href="<?php echo base_url('admin/orders/view_route/'.$orders->order_id.'/'.$v_order->id) ?>" target = "_blank" class="btn btn-xs btn-info" title="" data-toggle="tooltip" data-placement="top" data-original-title="View Route">Route</a> | 
                                    <a href="<?php echo base_url('admin/orders/print_route/'.$orders->order_id.'/'.$v_order->id) ?>" target = "_blank" class="btn btn-xs btn-info" title="" data-toggle="tooltip" data-placement="top" data-original-title="print Route">Print Route</a> |
                                    <a href="<?php echo base_url('admin/orders/print_all_route/'.$orders->order_id) ?>" target = "_blank" class="btn btn-xs btn-info" title="" data-toggle="tooltip" data-placement="top" data-original-title="Print All Routes">Print All Routes</a>
                            </td>
                        </tr>
                            <?php $counter ++?>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>

                        <tr>
                            <td colspan="1"></td><td colspan="1"></td><td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="1">Order TOTAL</td>
                            <td class="qty text-center"><?php echo '£ '.$total; ?></td>
                        </tr>
                        </tfoot>
                    </table>

                </main>
            </div>
        </div>
            </div>


    </div><!-- /.box-body -->
</div><!-- /.box -->





