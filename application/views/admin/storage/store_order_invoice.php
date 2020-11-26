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

<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->
<div class="box">
    <div class="box-header box-header-background with-border">
        <h3 class="box-title">Storage Order Invoice</h3>
        <div class="box-tools pull-right">
            <!-- Buttons, labels, and many other things can be placed here! -->
            <!-- Here is a label for example -->
            <div class="box-tools">
                <div class="btn-group" role="group" >
                    <a onclick="print_invoice('printableArea')" class="btn btn-default ">Print</a>
                    <a href="<?php echo base_url() ?>admin/storage/store_pdf_invoice/<?php echo $invoice_info->storage_invoice_no ?>" class="btn btn-default ">PDF</a>
                    
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
                            <h2 class="name"><?php echo $order_info->customer_name ?></h2>
                            <div class="email">FC No: <?php echo $order_info->fc_no ?></div>
                            <div class="address"><?php echo $order_info->address ?></div>
                            <div class="address">Mobile: <?php echo $order_info->phone ?></div>
                            
                        </div>
                        <?php if(!empty($order_info->shipping_address)):?>
                        <div id="shipping">
                            <div class="to">CUSTOMER SHIPPING INFO:</div>

                            <div class="address"><?php
                                echo  $order_info->shipping_address;
                                ?></div>

                        </div>
                        <?php endif ?>

                        <div id="invoice">
                            <h1 style="font-size: 1.8em;">Acquisition No: <?php echo $order_info->acquisition ?></h1>
                            <div class="date">Date of Invoice: <?php echo date('Y-m-d', strtotime($invoice_info->storage_invoice_date )) ?></div>
                            <div class="date">Storage By: <?php echo $order_info->store_by ?></div>
                            <h4>INVOICE <?php echo $invoice_info->storage_invoice_no ?></h4>

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
                            <td><?php echo $order_info->storage_days;?></td>
                        </tr>

                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Cost Per Day</td>
                            <td><?php echo $order_info->cost_per_day; ?></td>
                        </tr>

                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td><?php echo $currency.' '.number_format($order_info->total_cost,2) ?></td>
                        </tr>
                        </tfoot>
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





