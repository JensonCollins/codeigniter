<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->


<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary ">
                <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">Manage Storage Order</h3>
                    <div class="box-tools">
                        <a onclick="print_invoice('printableArea')" class="btn btn-default">Print</a>

                    </div>
                </div>
                <div class="box-body">
                    <div id="printableArea">
                        <!-- Table -->
                        <table class="table table-bordered table-striped" id="dataTables-example">
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active">Sl</th>
                                <th class="active">Storage Order No</th>
                                <th class="active">Storage Order Date</th>
                                <th class="active">Storage Order Status</th>
                                <th class="active">Acquisition No</th>
                                <th class="active">Storage By</th>
                                <th class="active">Action</th>

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php $counter =1 ; ?>
                            <?php if (!empty($storage)): foreach ($storage as $v_order) : ?>
                                <tr class="custom-tr">
                                    <td class="vertical-td">
                                        <?php echo  $counter ?>
                                    </td>
                                    <td class="vertical-td">STO-<?php echo $v_order->store_order_no ?></td>
                                    <td class="vertical-td"><?php echo date('Y-m-d', strtotime($v_order->store_order_date ))?></td>
                                    <td class="vertical-td">
                                        <?php
                                          if($v_order->store_order_status == 1){
                                              echo 'In Storage';
                                        }else{
                                            echo 'Collected';
                                        }
                                        ?>
                                    </td>
                                    <td class="vertical-td"><?php echo $v_order->acquisition ?></td>
                                    <td class="vertical-td"><?php echo $v_order->store_by ?></td>

                                    <td class="vertical-td">
                                        <?php echo btn_edit('admin/storage/store_view_order/' . $v_order->store_order_no); ?>

                                    </td>

                                </tr>
                            <?php
                                $counter++;
                            endforeach;
                            ?><!--get all sub category if not this empty-->
                            <?php else : ?> <!--get error message if this empty-->
                                <td colspan="6">
                                    <strong>There is no record for display</strong>
                                </td><!--/ get error message if this empty-->
                            <?php endif; ?>
                            </tbody><!-- / Table body -->
                        </table> <!-- / Table -->
                        </div>

                </div><!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>




