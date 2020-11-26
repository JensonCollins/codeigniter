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
                                        <a href="<?php echo base_url('admin/orders/print_route/'.$v_order['order_id'].'/'.$v_order['job_no']) ?>" target = "_blank" class="btn btn-customs btn-xs" title="" data-toggle="tooltip" data-placement="top" data-original-title="print Route">Print Route Card</a>
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