<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->

<?php $CI =& get_instance();  ?>
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary ">
                <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">Manage Orders</h3>
                </div>

                <div class="row ">
                    <div class="col-sm-12">
                        <div id="dataTables-example_filter" class="dataTables_filter">
                            <label>
                                Search:
                                <input type="search" style="margin:0px 10px;" class="form-control input-sm pull-right" aria-controls="dataTables-example" id="keywords" onkeyup="searchFilter();">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="box-body" id="itemList">

                        <!-- Table -->
                        <table class="table table-bordered table-striped">
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active">Order ID</th>
                                <th class="active">Customer</th>
                                <th class="active">Order No</th>
                                <th class="active">Date In</th>
                                <th class="active">Action</th>

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php $counter =1 ; ?>
                            <?php
                            $pagination_array = $this->ajax_pagination->create_links();
                            if (!empty($orders)): foreach ($orders as $v_order) : ?>
                                <tr class="custom-tr">
                                    <td class="vertical-td"><?php echo $v_order['order_id'] ?></td>
                                    <td class="vertical-td"><?php echo $CI->get_customer_name($v_order['customer_id']) ?></td>
                                    <td class="vertical-td"><?php echo $v_order['OrderNo'] ?></td>
                                    <td class="vertical-td"><?php 
                                        $date = trim($v_order['DateIn']);
                                        if($date){
                                            if(strlen($date) == 8){
                                                if(strpos($date, '.')){
                                                    $date_parts = explode('.', $date);
                                                }
                                                else{
                                                    $date_parts = explode('/', $date);
                                                }
                                                $d = $date_parts[0];
                                                $m = $date_parts[1];
                                                $y = $date_parts[2];
                                                $y = '20' . $y;
                                                
                                                echo $d . '/' . $m . '/' . $y;
                                            }
                                            else if(strlen($date) > 8){
                                                echo str_replace('.', '/', $date);
                                            }
                                            else{
                                                echo date('d/m/Y', strtotime($date));
                                            }
                                        }
                                        else{
                                            echo $date;
                                        }
                                    // echo $v_order['DateIn']; ?></td>

                                    <td class="vertical-td">
                                        <?php echo btn_edit('admin/orders/add_order/' . $v_order['order_id']); ?>
                                        <?php echo btn_delete('admin/orders/delete_order/' . $v_order['order_id']); ?>
                                        <?php echo btn_view('admin/orders/view_order/' . $v_order['order_id']); ?>
                                    </td>

                                </tr>
                            <?php
                                $counter++;
                            endforeach;
                            ?>
                            <?php else : ?>
                                <td colspan="7">
                                    <strong>There is no record for display</strong>
                                </td>
                            <?php endif; ?>
                            </tbody>
                        </table> 
                        <?php
                        if (isset($pagination_array['output'])) {
                            echo $pagination_array['output'];
                        }
                        ?>

                </div><!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>

<script>
    function searchFilter(page_num) {
        page_num = page_num ? page_num : 0;
        var keywords = $('#keywords').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/orders/ajaxPaginationData/' + page_num,
            data: 'page=' + page_num + '&keywords=' + keywords ,
                    
            beforeSend: function() {
                $('.loading').show();
            },
            success: function(html) {
                console.log(status);
                $('#itemList').html(html);
                $('.loading').fadeOut("slow");
            }
        });
        
    }
    
</script>




