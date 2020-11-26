                        <table class="table table-bordered table-striped" id="dataTables-example1">
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
                                    <td class="vertical-td">
                                        <?php 
                                        if(isset($v_order['LongName'])){
                                            echo $v_order['LongName'];
                                        }
                                            
                                        ?>
                                    </td>
                                        
                                    <!--<td class="vertical-td"><?php //echo $CI->get_customer_name($v_order['customer_id']) ?></td>-->
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




