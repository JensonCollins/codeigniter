<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->


<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary ">
                <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">Manage Parts</h3>
                </div>


                <div class="box-body">

                        <!-- Table -->
                        <table class="table table-bordered table-striped" id="dataTables-example">
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active" style="display:none;">Sl</th>
                                <th class="active">Part #</th>
                                <th class="active">Customer</th>
                                <th class="active">Description</th>
                                <th class="active">Action</th>

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php $counter =1 ; ?>
                            <?php if (!empty($parts)): foreach ($parts as $v_parts) : ?>
                                <tr class="custom-tr">
                                    <td class="vertical-td" style="display:none;">
                                        <?php echo  $counter ?>
                                    </td>
                                    <td class="vertical-td"><?php echo $v_parts->PartNo ?></td>
                                    <td class="vertical-td"><?php echo $v_parts->Customer ?></td>
                                    <td class="vertical-td"><?php echo $v_parts->Description ?></td>

                                    <td class="vertical-td">
                                        <?php echo btn_edit('admin/parts/add_parts/' . $v_parts->id); ?>
                                        <?php echo btn_delete('admin/parts/delete_part/' . $v_parts->id); ?>
                                        <?php echo btn_view('admin/parts/view_part/' . $v_parts->id); ?>
                                        <a href="<?php echo base_url('admin/parts/view_history/').'/'.$v_parts->id ; ?>" class="btn bg-olive btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="History"><span class="fa fa-history"></span></a>
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




