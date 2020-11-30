<!-- View message -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">
                    <div class="col-md-offset-3">
                        <h3 class="box-title ">Add Customer</h3>
                    </div>
                </div>
                <!-- /.box-header -->

                <!-- form start -->
                <form role="form" enctype="multipart/form-data" id="addCustomerForm"
                      action="<?php echo base_url(); ?>admin/customer/save_customer/<?php if (!empty($customer->customer_id)) {
                          echo $customer->customer_id;
                      } ?>"
                      method="post">

                    <div class="row">

                        <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Customer Short Name <span class="required">*</span></label>
                                    <input type="text" name="ShortName" placeholder="Customer Short Name"
                                           value="<?php
                                           if (!empty($customer->ShortName)) {
                                               echo htmlspecialchars($customer->ShortName);
                                           }
                                           ?>"
                                           class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Customer Long Name <span class="required">*</span></label>
                                    <input type="text" name="LongName" placeholder="Customer Long Name"
                                           value="<?php
                                           if (!empty($customer->LongName)) {
                                               echo htmlspecialchars($customer->LongName);
                                           }
                                           ?>"
                                           class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Contact <span
                                            class="required">*</span></label>
                                    <input type="text" placeholder="Contact" name="Contact"
                                           value="<?php
                                           if (!empty($customer->Contact)) {
                                               echo htmlspecialchars($customer->Contact);
                                           }
                                           ?>"
                                           class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone</label>
                                    <input type="text" placeholder="Phone" name="phone" onchange="check_phone(this.value)"
                                           value="<?php
                                           if (!empty($customer->phone)) {
                                               echo htmlspecialchars($customer->phone);
                                           }
                                           ?>"
                                           class="form-control">
                                    <div style=" color: #E13300" id="phone_result"></div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Notes</label>
                                    <!--<label for="exampleInputEmail1">Notes <span class="required">*</span></label>-->
                                    <textarea name="notes" class="form-control autogrow" id="ck_editor"
                                              placeholder="Notes"><?php
                                        if (!empty($customer->notes)) {
                                            echo $customer->notes;
                                        }
                                        ?></textarea>
                                    <?php echo display_ckeditor($editor['ckeditor']); ?>
                                </div>


                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>

                    <!-- customer id -->
                    <input type="hidden" name="customer_id" value="<?php if (!empty($customer->customer_id)) {
                        echo $customer->customer_id;
                    } ?>" id="customer_id">

                    <div class="box-footer">
                        <button type="submit" id="customer_btn" class="btn bg-navy col-md-offset-3" type="submit">Create Customer
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>

<script src="<?php echo base_url() ?>asset/js/ajax.js" ></script>
