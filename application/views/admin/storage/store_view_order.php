<script src="<?php echo base_url(); ?>asset/js/ajax.js" xmlns="http://www.w3.org/1999/html"></script>

<?php
$info = $this->session->userdata('business_info');
if(!empty($info->currency))
{
    $currency = $info->currency ;
}else
{
    $currency = '$';
}
?>

<?php
//company logo
if(!empty($info->logo)){
    $logo = $info->logo;
}else{
    $logo = 'img/logo.png';
}

if(!empty($info->company_name)){
    $company_name = $info->company_name;
}else{
    $company_name = 'Your Company Name';
}
//company phone
if(!empty($info->phone)){
    $company_phone = $info->phone;
}else{
    $company_phone = 'Company Phone';
}
//company email
if(!empty($info->email)){
    $company_email = $info->email;
}else{
    $company_email = 'Company Email';
}
//company address
if(!empty($info->address)){
    $address = $info->address;
}else{
    $address = 'Company Address';
}



?>

<div class="box">
    <div class="box-header box-header-background with-border">
        <h3 class="box-title">View Storage Order</h3>
        <div class="box-tools pull-right">
            <!-- Buttons, labels, and many other things can be placed here! -->
            <!-- Here is a label for example -->
            <div class="box-tools">
                <div class="btn-group" role="group" >
                    <a onclick="print_invoice('printableArea')" class="btn btn-default ">Print</a>

                </div>
            </div>

        </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">


        <div id="printableArea">
            <link href="<?php echo base_url(); ?>asset/css/invoice.css" rel="stylesheet" type="text/css" />



            <div class="row ">


            <div class="col-md-8 col-md-offset-2">

                <main>
                    <div id="details" class="clearfix">
                        <div id="client" style="margin-right: 100px">
                            <div class="to">CUSTOMER BILLING INFO:</div>
                            <h2 class="name"><?php echo $order_info->customer_name ?></h2>
                            <div class="email">FC No: <?php echo $order_info->fc_no ?></div>
                            <div class="address">Address: <?php echo $order_info->address ?></div>
                            <div class="address">Tel No: <?php echo $order_info->phone ?></div>
                        </div>


                        <div id="invoice">
                            <h1 style="font-size: 1.8em;">Acquisition No: <?php echo $order_info->acquisition ?></h1>
                            <div class="date">Date of Order: <?php echo date('Y-m-d', strtotime($order_info->store_order_date))  ?></div>
                            <div class="date">Storage By: <?php echo $order_info->store_by ?></div>
                            <h4>ORDER <?php echo $order_info->store_order_no ?></h4>

                            <?php if($order_info->store_order_status == 1){ ?>
                                <form method="post" action="<?php echo base_url()?>admin/storage/order_re_confirmation">
                                <!-- pending Order-->
                                <div>
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Order Status</label>

                                        <div class="col-sm-7">
                                            <select name="store_order_status" class="form-control" id="order_confirmation">
                                                <option value="1" <?php echo $order_info->store_order_status ==1? 'selected':''?>>In Storage</option>
                                                <option value="2" <?php echo $order_info->store_order_status ==2? 'selected':''?> >Collected</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                    <input type="hidden" name="store_order_id" value="<?php echo $order_info->store_order_id ?>">
                                    <input type="hidden" name="store_order_no" value="<?php echo $order_info->store_order_no ?>">
                                <div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn bg-navy btn-block">Submit</button>
                                        </div>
                                    </div>

                                </div>
                                </form>

                            <?php }elseif($order_info->order_status == 2){ ?>
                                <!-- cancel Order-->
                                <div class="date">Order Status: <?php echo 'Cancel Order' ?></div>
                            <?php }else{ ?>
                                <!-- confirm Order-->
                                <div class="date">Order Status: <?php echo 'Confirm Order' ?></div>
                            <?php } ?>

                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th class="no text-right">#</th>
                            <th class="desc">Product</th>
                            <th class="desc">Type</th>
                            <th class="desc">Calibre</th>
                            <th class="desc">Serial</th>
                            <th class="qty text-right">Qty</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $counter = 1?>
                        <?php foreach($order_details as $v_order): ?>
                        <tr>
                            <td class="no"><?php echo $counter ?></td>
                            <td class="desc"><h3><?php echo $v_order['product_name'] ?></h3></td>
                            <td class="desc"><?php echo $v_order['subcategory_id'] ?></td>
                            <td class="desc"><?php echo $v_order['product_calibre'] ?></td>
                            <td class="desc"><?php echo $v_order['product_serial'] ?></td>
                            <td class="total"><?php echo $v_order['product_quantity'] ?></td>
                        </tr>
                            <?php $counter ++?>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Storage Days</td>
                            <td class="qty text-right"><?php echo $order_info->storage_days;?></td>
                        </tr>

                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Cost Per Day</td>
                            <td class="qty text-right"><?php echo $order_info->cost_per_day; ?></td>
                        </tr>

<!--                         <?php if($order_info->discount):?>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">Discount Amount</td>
                                <td><?php echo number_format($order_info->discount_amount,2) ?></td>
                            </tr>
                        <?php endif; ?> -->

                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td class="qty text-right"><?php echo $currency.' '.number_format($order_info->total_cost,2) ?></td>
                        </tr>
                        </tfoot>
                    </table>

                </main>
                <hr/>
                <footer class="text-center">
                    <strong><?php echo $company_name?></strong>&nbsp;&nbsp;&nbsp;<?php echo $address ?>
                </footer>


            </div>
        </div>
            </div>


    </div><!-- /.box-body -->
</div><!-- /.box -->





