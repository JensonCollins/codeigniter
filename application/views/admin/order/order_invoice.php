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

//company details
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

<!--Message-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Message-->
<div class="box">
    <div class="box-header box-header-background with-border">
        <h3 class="box-title">Order Invoice</h3>
        <div class="box-tools pull-right">
            <!-- Buttons, labels, and many other things can be placed here! -->
            <!-- Here is a label for example -->
            <div class="box-tools">
                <div class="btn-group" role="group" >
                    <a onclick="print_invoice('printableArea')" class="btn btn-default ">Print</a>
                    <a href="<?php echo base_url() ?>admin/order/pdf_invoice/<?php echo $invoice_info->invoice_no ?>" class="btn btn-default ">PDF</a>
                    <!-- <a href="<?php echo base_url() ?>admin/order/email_invoice/<?php echo $invoice_info->invoice_no ?>" class="btn btn-default " <?php
                    echo $order_info->customer_email == '' ? 'disable':''
                    ?>>Email to Customer</a> -->
                </div>
            </div>

        </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">


        <div id="printableArea">
            <link href="<?php echo base_url(); ?>asset/css/invoice.css" rel="stylesheet" type="text/css" />



            <div class="row ">


            <div class="col-md-8 col-md-offset-2">

                <header class="clearfix">
                    <div id="logo">
                        <img src="<?php  echo base_url(). $logo?>">
                    </div>
                    <div id="company">
                        <h2 class="name"><?php echo $company_name ?></h2>
                        <div><?php echo $company_phone?></div>
                        <div><?php echo $company_email?></div>
                    </div>

                </header>
                <hr/>
                <main>
                    <div id="details" class="clearfix">
                        <div id="client" style="margin-right: 100px">
                            <div class="to">CUSTOMER BILLING INFO:</div>
                            <h2 class="name"><?php echo $order->customer_name ?></h2>
                            <div class="email">FC. No: <?php echo $order->customer_fc ?><br></div>
                            <div class="address"><?php echo $order->customer_address ?><br></div>
                            <div class="address">Mobile: <?php echo $order->customer_phone ?></div>
                            
                        </div>
                        <?php if(!empty($order->shipping_address)):?>
                        <div id="shipping">
                            <div class="to">CUSTOMER SHIPPING INFO:</div>

                            <div class="address"><?php
                                echo  $order->shipping_address;
                                ?></div>

                        </div>
                        <?php endif ?>

                        <div id="invoice">
                            <h2>INVOICE <?php echo $invoice_info->invoice_no ?></h2>
                            <div class="date">Invoice Date: <?php echo date('Y-m-d', strtotime($invoice_info->invoice_date )) ?></div>
                            <div class="date">Sales Person: <?php echo $order->sales_person ?></div>
                            <h4>DISPOSAL NO <?php echo $order->disposal_no ?></h4>

                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th class="no text-right">#</th>
                            <th class="desc">DESCRIPTION</th>
                            <th class="desc">TYPE</th><!--This refers to product subcategory name-->
                            <th class="desc">SERIAL</th><!--This refers to product serial name-->
                            <th class="qty text-right">QUANTITY</th>
                            
                        </tr>
                        </thead>
                        <tbody>
                        <?php $counter = 1?>
                        <?php foreach($order_details as $v_order): ?>
                        <tr>
                            <td class="no"><?php echo $counter ?></td>
                            <td class="desc"><h3><?php echo $v_order->product_name ?></h3></td>
                            <!--Replace Selling Price with Product Subcategory Name-->
                            <td class="desc"><?php echo number_format($v_order->selling_price, 2); ?></td>
                            <!--Replace total with Product Serial-->
                            <td class="total"><?php echo number_format($v_order->sub_total,2) ?></td>
                            <td class="qty"><?php echo $v_order->product_quantity ?></td>
                        </tr>
                            <?php $counter ++?>
                        <?php endforeach; ?>
                        </tbody>
                        <!-- <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td><?php echo number_format($order->sub_total,2) ?></td>
                        </tr>

                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Tax</td>
                            <td><?php echo number_format($order->total_tax,2) ?></td>
                        </tr>

                        <?php if($order_info->discount):?>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">Discount Amount</td>
                                <td><?php echo number_format($order->discount_amount,2) ?></td>
                            </tr>
                        <?php endif; ?>

                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td><?php echo $currency.' '.number_format($order->grand_total,2) ?></td>
                        </tr>
                        </tfoot> -->
                    </table>

                </main>
                <hr/>
                <footer class="text-center">
                    <strong><?php echo $company_name ?></strong>&nbsp;&nbsp;&nbsp;<?php echo $address ?>
                </footer>


            </div>
        </div>
            </div>


    </div><!-- /.box-body -->
</div><!-- /.box -->





