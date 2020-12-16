<?php $CI =& get_instance();?>
<div class="box">
    <div class="box-header box-header-background with-border hide-print">
        <h3 class="box-title">View Order</h3>
        <div class="box-tools pull-right">
            <!-- Buttons, labels, and many other things can be placed here! -->
            <!-- Here is a label for example -->
            <div class="box-tools hide-print">
                <div class="btn-group" role="group" >
                    <a href="<?php echo base_url().'admin/orders/print_order/'.$orders->order_id ?>" class="btn btn-default" target = "_blank">Print</a>

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
                            <div class="email">PO #: <?php  if(!empty($orders->OrderNo)) { echo $orders->OrderNo ; } else { echo "N/A"; }?></div>
                            <div class="email">Date In: <?php  if(!empty($orders->DateIn)) { echo date('d.m.Y', strtotime($orders->DateIn));  } else { echo "N/A"; }?></div>
                            <div class="email">Date Out: <?php  if(!empty($orders->DueDeliveryDate)) { echo date('d.m.Y', strtotime($orders->DueDeliveryDate));} else { echo "N/A"; } ?></div>
                            <div class="address">Customer: <?php  if(!empty($orders->customer_id)) { echo $CI->get_customer_name($orders->customer_id); } else { echo "N/A"; } ?></div>
                            <div class="address">Tel No: <?php  if(!empty($orders->customer_id)) { echo $CI->get_customer_phone($orders->customer_id);  } else { echo "N/A"; }?></div>
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
                            <th class="no">Part's Price</th>
                            <th class="no hide-print">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $counter = 1; $total = 0;?>
                        <?php foreach($order_parts as $v_order) {
							$part_info = $CI->get_part_info($v_order->part_id);
							if ($part_info) {
								$total = $v_order->quantity * $part_info->Price + $total;
							} else {
								$total = 0;
							}
                        ?>
                        <tr>
                            <td class="text-right"><?php echo $counter ; ?></td>
                            <td class="desc" style="text-align: center;"><h3><?php echo $v_order->id ?></h3></td>
                            <td class="desc" style="text-align: center;"><?php if(!empty($part_info->PartNo)) { echo $part_info->PartNo ; } else { echo "N/A"; }?></td>
                            <td class="desc" style="text-align: center;"><?php if(!empty($v_order->quantity)) { echo $v_order->quantity  ; } else { echo "N/A"; } ?></td>
                            <td class="desc" style="text-align: center;"><?php if(!empty($part_info->Description)) { echo $part_info->Description ; } else { echo "N/A"; }?></td>
                            <td class="total" style="text-align: center;"><?php if(!empty($part_info->Price)) { echo $part_info->Price ; } else { echo "N/A"; }?></td>
                            <td class="vertical-td hide-print">
								<a href="<?php echo base_url('admin/orders/view_job/'.$orders->order_id.'/'.$v_order->id ) ?>" target = "_blank" class="btn btn-xs btn-primary" title="" data-toggle="tooltip" data-placement="top" data-original-title="View Job">Job</a> |
								<a href="<?php echo base_url('admin/orders/print_job/'.$orders->order_id.'/'.$v_order->id ) ?>" target="_blank"  class="btn btn-xs btn-primary" title="" data-toggle="tooltip" data-placement="top" data-original-title="Print Job">Print Job</a> |
								<a href="<?php echo base_url('admin/orders/print_all_job/'.$orders->order_id) ?>" target = "_blank" class="btn btn-xs btn-primary" title="" data-toggle="tooltip" data-placement="top" data-original-title="Print All Jobs">Print All Jobs</a> |
								<a href="<?php echo base_url('admin/orders/view_route/'.$orders->order_id.'/'.$v_order->id) ?>" target = "_blank" class="btn btn-xs btn-info" title="" data-toggle="tooltip" data-placement="top" data-original-title="View Route">Route</a> |
								<a href="<?php echo base_url('admin/orders/print_route/'.$orders->order_id.'/'.$v_order->id) ?>" target = "_blank" class="btn btn-xs btn-info" title="" data-toggle="tooltip" data-placement="top" data-original-title="print Route">Print Route</a> |
								<a href="<?php echo base_url('admin/orders/print_all_route/'.$orders->order_id) ?>" target = "_blank" class="btn btn-xs btn-info" title="" data-toggle="tooltip" data-placement="top" data-original-title="Print All Routes">Print All Routes</a> |
								<a href="<?php echo base_url('admin/orders/view_t_card/'.$orders->order_id.'/'.$v_order->id) ?>" target = "_blank" class="btn btn-xs btn-success" title="" data-toggle="tooltip" data-placement="top" data-original-title="View T-Card">View T-Card</a> |
								<a href="<?php echo base_url('admin/orders/print_t_card/'.$orders->order_id.'/'.$v_order->id) ?>" target = "_blank" class="btn btn-xs btn-success" title="" data-toggle="tooltip" data-placement="top" data-original-title="Print T-Card">Print T-Card</a> |
								<a href="<?php echo base_url('admin/orders/print_all_t_card/'.$orders->order_id) ?>" target = "_blank" class="btn btn-xs btn-success" title="" data-toggle="tooltip" data-placement="top" data-original-title="Print All T-Card">Print All T-Card</a>
                            </td>
                        </tr>
                            <?php $counter ++?>
                        <?php } ?>
                        </tbody>
                        <tfoot>

                        <tr>
                            <td colspan="1"></td><td colspan="1"></td><td colspan="1"></td>
                            <td colspan="1"></td><td></td>
                            <td colspan="1">Order TOTAL</td>
                            <td class="qty" align="right" style="padding-right: 0px;"><?php echo '£ '.number_format($total, 2); ?></td>
                        </tr>
                        </tfoot>
                    </table>

                </main>
            </div>
        </div>
            </div>


    </div><!-- /.box-body -->
</div><!-- /.box -->


<style>
   @media print {       
       table tr td:last-child {display:none}
       table tr th:last-child {display:none}
       
       hide-print{
           display:none!important;
       }
   }
</style>


