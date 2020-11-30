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
                        <h3 class="box-title ">Manage Jobs</h3>
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
                               <!--  <th class="active">#</th> -->
                                <th class="active">Job No</th>
                                <th class="active">Customer</th>
                                <th class="active">Part No</th>
                                <th class="active">Status</th>
                                <th class="active">Action</th>

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php $counter =1 ; ?>
                            <?php 
                            $pagination_array = $this->ajax_pagination->create_links();
                            if (!empty($order_parts)): foreach ($order_parts as $v_order) :  ?>
                                <tr class="custom-tr">
<!--                                     <td class="vertical-td">
                                        <?php //echo  $counter; ?>
                                    </td> -->
                                    <td class="vertical-td"><?php if(!empty($v_order['job_no'])) { echo $v_order['job_no'] ; } else { echo "N/A"; }  ?></td>
                                    <td class="vertical-td"><?php if(!empty($v_order['customer_name'])) { echo $v_order['customer_name'] ; } else { echo "N/A"; }?></td>
                                    <td class="vertical-td"><?php if(!empty($v_order['part_no'])) { echo $v_order['part_no'] ; } else { echo "N/A"; }  ?></td>
                                    <td class="vertical-td"><?php if(!empty($v_order['STATUS'])) { echo $v_order['STATUS'] ; } else { echo "N/A"; } ?></td>

									<td class="vertical-td">
                                        <a href="<?php echo base_url('admin/jobs/edit_job/'.$v_order['order_id'].'/'.$v_order['job_no'] ) ?>" target = "_blank" class="btn btn-customs btn-xs" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit Job">Edit</a> |
					<a href="<?php echo base_url('admin/orders/view_job/'.$v_order['order_id'].'/'.$v_order['job_no'] ) ?>" target = "_blank" class="btn btn-customs btn-xs" title="" data-toggle="tooltip" data-placement="top" data-original-title="View Job">Job Card</a> | 
                                        <a href="<?php echo base_url('admin/orders/print_job/'.$v_order['order_id'].'/'.$v_order['job_no'] ) ?>" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="Print Job">Print Job Card</a> | 
                                        <a href="<?php echo base_url('admin/orders/view_route/'.$v_order['order_id'].'/'.$v_order['job_no']) ?>" target = "_blank" class="btn btn-customs btn-xs" title="" data-toggle="tooltip" data-placement="top" data-original-title="View Route">Route Card</a> | 
                                        <a href="<?php echo base_url('admin/orders/print_route/'.$v_order['order_id'].'/'.$v_order['job_no']) ?>" target = "_blank" class="btn btn-customs btn-xs" title="" data-toggle="tooltip" data-placement="top" data-original-title="print Route">Print Route Card</a> |
										<a href="<?php echo base_url('admin/orders/view_t_card/'.$v_order['order_id'].'/'.$v_order['job_no']) ?>" target = "_blank" class="btn btn-customs btn-xs" title="" data-toggle="tooltip" data-placement="top" data-original-title="View T-Card">T-Card</a> |
										<a href="<?php echo base_url('admin/orders/print_t_card/'.$v_order['order_id'].'/'.$v_order['job_no']) ?>" target = "_blank" class="btn btn-customs btn-xs" title="" data-toggle="tooltip" data-placement="top" data-original-title="Print T-Card">print T-Card</a>
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
                        <?php
                        if (isset($pagination_array['output'])) {
                            echo $pagination_array['output'];
                        }
                        ?>
                </div><!-- /.box-body -->

<!--				<div class="box-footer">
				<?php  //echo $links; ?>
				</button>
				</div>-->
            </div>
            <!-- /.box -->
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>



<script>
    function searchFilter(page_num) {
//        alert();
        page_num = page_num ? page_num : 0;
        var keywords = $('#keywords').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/jobs/ajaxPaginationData/' + page_num,
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



