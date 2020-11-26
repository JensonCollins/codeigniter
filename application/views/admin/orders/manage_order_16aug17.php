<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error');?>
<!--/ Massage-->

<?php $CI =& get_instance(); ?>
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary ">
                <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">Manage Orders</h3>
                </div>


                <div class="box-body">

                        <!-- Table -->
                        <table class="table table-bordered table-striped" id="dataTables-example">
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active">Sl</th>
                                <th class="active">Order ID</th>
                                <th class="active">Customer</th>
                                <th class="active">Order No</th>
                                <th class="active">Date In</th>
                                <th class="active">Action</th>

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php $counter =1 ; ?>
                            <?php if (!empty($orders)): foreach ($orders as $v_order) : ?>
                                <tr class="custom-tr">
                                    <td class="vertical-td">
                                        <?php echo  $counter ?>
                                    </td>
                                    <td class="vertical-td"><?php echo $v_order->order_id; ?></td>
                                    <td class="vertical-td"><?php echo $CI->get_customer_name($v_order->customer_id); ?></td>
                                    <td class="vertical-td"><?php echo $v_order->OrderNo; ?></td>
                                    <td class="vertical-td"><?php echo $v_order->DateIn; ?></td>

                                    <td class="vertical-td">
                                        <?php echo btn_edit('admin/orders/add_order/' . $v_order->order_id); ?>
                                        <?php echo btn_delete('admin/orders/delete_order/' . $v_order->order_id); ?>
                                        <?php echo btn_view('admin/orders/view_order/' . $v_order->order_id); ?>
                                    </td>

                                </tr>
                            <?php
                                $counter++;
                            endforeach;
                            ?><!--get all sub category if not this empty-->
                            <?php else : ?> <!--get error message if this empty-->
                                <td colspan="7">
                                    <strong>There is no record for display</strong>
                                </td><!--/ get error message if this empty-->
                            <?php endif; ?>
                            </tbody><!-- / Table body -->
                        </table> <!-- / Table -->

                </div><!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>




