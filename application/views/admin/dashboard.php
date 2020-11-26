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

<section class="content">

<!-- Main row -->
<div class="row">

    <div class="col-md-3">
        <!-- Info Boxes Style 2 -->
        <div class="info-box bg-yellow">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-qrcode"></i></span>
                    <div class="info-box-content box-color">
                        <span class="info-box-text">TOTAL Parts</span>
                        <span class="info-box-number"><?php echo $total_parts ?></span>
                        <a href="<?php echo base_url() ?>admin/parts/manage_parts" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
        </div><!-- /.info-box -->
        <div class="info-box bg-green">
            <div class="info-box">
                <span class="info-box-icon bg-purple"><i class="glyphicon glyphicon-shopping-cart"></i></span>
                <div class="info-box-content box-color">
                    <span class="info-box-text">TOTAL ORDER</span>
                    <span class="info-box-number"><?php echo $total_order ?></span>
                    <a href="<?php echo base_url() ?>admin/orders/manage_order" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.info-box -->
    </div><!-- /.col -->

    <div class="col-md-3">
        <div class="info-box bg-aqua">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-user"></i></span>
                <div class="info-box-content box-color">
                    <span class="info-box-text">TOTAL CUSTOMER</span>
                    <span class="info-box-number"><?php echo $total_customer?></span>
                    <a href="<?php echo base_url() ?>admin/customer/manage_customer" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.info-box -->
    </div><!-- /.col -->
</div><!-- /.row -->


</section>

<script>

    function addCommas(nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }


</script>


