<?php $CI =& get_instance();?>
<div class="box">
    <div class="box-header box-header-background with-border">
        <h3 class="box-title">View Part History</h3>
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
                            <div class="email"><b>Part #:</b> <?php if(!empty($parts->PartNo)) { echo $parts->PartNo; } else { echo "N/A"; } ?></div>
                            <div class="email"><b>Description:</b> <?php if(!empty($parts->Description)) { echo $parts->Description; } else { echo "N/A"; } ?></div>
                            <div class="email"><b>Price:</b> <?php if(!empty($parts->Price)) { echo '£ '.$parts->Price; } else { echo "N/A"; } ?></div>
                            <div class="address"><b>Customer:</b> <?php if(!empty($parts->Customer)) { echo $parts->Customer; } else { echo "N/A"; } ?></div>
                            <div class="address"><b>Material:</b> <?php if(!empty($parts->Material)) { echo $parts->Material; } else { echo "N/A"; } ?></div>
                            <div class="address"><b>Material Description:</b> <?php if(!empty($parts->MatDescription)) { echo $parts->MatDescription; } else { echo "N/A"; } ?></div>
                            <div class="address"><b>Part Notes:</b> <?php if(!empty($parts->Notes)) { echo $parts->Notes; } else { echo "N/A"; } ?></div>
                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th class="no text-right">#</th>
                            <th class="no">Qty</th>
                            <th class="no">Date In</th>
                            <th class="no">Order#</th>
                            <th class="no">Price</th>
                            <th class="no">Order Price</th>
                            <th class="no">Job#</th>
                            <th class="no">Mat Supplier</th>
                            <th class="no">Mat Cost</th>
                            <th class="no">Job Notes</th>
                            <th class="no">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $counter = 1; $total = 0;?>
                        <?php foreach($order_parts as $v_order):?>
                        <tr>
                            <td class="text-right"><?php echo $counter ; ?></td>
                            <td class="desc" style="text-align: center;"><h3><?php  if(!empty($v_order->quantity)) { echo $v_order->quantity  ; } else { echo "N/A"; } ?></h3></td>
                            <td class="desc" style="text-align: center;"><?php if(!empty($CI->get_order_info($v_order->order_id)->DateIn)) { echo $CI->get_order_info($v_order->order_id)->DateIn ; } else { echo "N/A"; } ?></td>
                            <td class="desc" style="text-align: center;"><?php if(!empty($CI->get_order_info($v_order->order_id)->OrderNo)) { echo $CI->get_order_info($v_order->order_id)->OrderNo ; } else { echo "N/A"; } ?></td>
                            <td class="desc" style="text-align: center;"><?php if(!empty($parts->Price)) { echo '£ '.$parts->Price; } else { echo "N/A"; } ?></td>
                            <td class="desc" style="text-align: center;"><?php  if(!empty($v_order->OrderPrice)) { echo '£ '.$v_order->OrderPrice  ; } else { echo "N/A"; } ?></td>
                            <td class="desc" style="text-align: center;"><?php  if(!empty($v_order->id)) { echo $v_order->id  ; } else { echo "N/A"; } ?></td>
                            <td class="desc" style="text-align: center;"><?php if(!empty($parts->MatSupplier)) { echo '£ '.$parts->MatSupplier; } else { echo "N/A"; } ?></td>
                            <td class="desc" style="text-align: center;"><?php  echo "N/A"; ?></td>
                            <td class="desc" style="text-align: center;"><?php  if(!empty($v_order->Notes)) { echo $v_order->Notes  ; } else { echo "N/A"; } ?></td>
                            <td class="desc" style="text-align: center;"><a href="<?php echo base_url('admin/orders/view_job/'.$v_order->order_id.'/'.$v_order->id ) ?>" target = "_blank" class="btn btn-customs btn-xs" title="" data-toggle="tooltip" data-placement="top" data-original-title="View Job">Job Card</a></td>
                           </td>
                        </tr>
                            <?php $counter ++?>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>

                </main>
            </div>
        </div>
            </div>


    </div><!-- /.box-body -->
</div><!-- /.box -->





