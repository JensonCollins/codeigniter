<!-- View message -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">
                    <div class="col-md-offset-3">
                        <h3 class="box-title ">View Part</h3>
                        <div class="pull-right">
                            <a id="edit_part" class="btn bg-navy" href="<?php echo base_url().'admin/parts/add_parts/'.$parts->id; ?>">Edit Part</a>                            
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

                <!-- form start -->
                <form role="form" enctype="multipart/form-data" id="addPartsForm"
                      action="<?php echo base_url(); ?>admin/parts/save_parts/<?php if (!empty($parts->id)) {
                          echo $parts->id;
                      } ?>"
                      method="post">

                    <div class="row">

                        <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">

                            <div class="box-body">
									<div class="form-group">
                                    <label for="exampleInputEmail1">Part #: </label>
                                    <?php
                                           if (!empty($parts->PartNo)) {
                                               echo $parts->PartNo;
                                           }
                                           else
                                           {
                                            echo "N/A";
                                           }
                                           ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description: </label>
                                    <?php
                                           if (!empty($parts->Description)) {
                                               echo $parts->Description;
                                           }
                                           else
                                           {
                                            echo "N/A";
                                           }
                                           ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Price: </label>
                                    <?php
                                           if (!empty($parts->Price)) {
                                               echo $parts->Price;
                                           }
                                           else
                                           {
                                            echo "N/A";
                                           }
                                           ?>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Customer: </label>
										   <?php
                                           if (!empty($parts->Customer)) {
                                               echo $parts->Customer;
                                           }
                                           else
                                           {
                                            echo "N/A";
                                           }
                                           ?>
                                </div>                                

                                <div class="form-group">
                                	<label for="exampleInputEmail1">Material: </label>
                                    <?php
                                           if (!empty($parts->Material)) {
                                               echo $parts->Material;
                                           }
                                           else
                                           {
                                            echo "N/A";
                                           }
                                           ?>
                                </div> 

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Material Description: </label>
                                   <?php
                                           if (!empty($parts->MatDescription)) {
                                               echo $parts->MatDescription;
                                           }
                                           else
                                           {
                                            echo "N/A";
                                           }
                                           ?>
                                </div> 

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Treatment: <!-- <span
                                            class="required">*</span> --></label>
										   <?php
                                           if (!empty($parts->Treatment)) {
                                               echo $parts->Treatment;
                                           }
                                           else
                                           {
                                            echo "N/A";
                                           }
                                           ?>
                                </div> 
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Treatment Cost: <!-- <span
                                            class="required">*</span> --></label>
                                    <?php
                                           if (!empty($parts->TreatmentCost)) {
                                               echo $parts->TreatmentCost;
                                           }
                                           else
                                           {
                                            echo "N/A";
                                           }
                                           ?>
                                </div> 

                                <?php
                                   if (!empty($parts->OperationF1)) {
                                ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Operation F1:</label>
                                <?php
                                        echo $parts->OperationF1;
                                ?>
                                </div>
                                <?php
                                    }
                                ?>
                                <?php
                                   if (!empty($parts->OperationF2)) {
                                ?>
                                test
                                <div class="form-group">
                                    <label for="exampleInputEmail2">Operation F2:</label>
                                <?php
                                        echo $parts->OperationF2;
                                ?>
                                </div>
                                <?php
                                    }
                                ?>
                                <?php
                                   if (!empty($parts->OperationF3)) {
                                ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Operation F3:</label>
                                <?php
                                        echo $parts->OperationF3;
                                ?>
                                </div>
                                <?php
                                    }
                                ?>
                                
                                <?php
                                   if (!empty($parts->OperationF4)) {
                                ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail4">Operation F4:</label>
                                <?php
                                        echo $parts->OperationF4;
                                ?>
                                </div>
                                <?php
                                    }
                                ?>
                                <?php
                                   if (!empty($parts->OperationF5)) {
                                ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail5">Operation F5:</label>
                                <?php
                                        echo $parts->OperationF5;
                                ?>
                                </div>
                                <?php
                                    }
                                ?>
                                <?php
                                   if (!empty($parts->OperationF6)) {
                                ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail6">Operation F6:</label>
                                <?php
                                        echo $parts->OperationF6;
                                ?>
                                </div>
                                <?php
                                    }
                                ?>
                                <?php
                                   if (!empty($parts->OperationF7)) {
                                ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail7">Operation F7:</label>
                                <?php
                                        echo $parts->OperationF7;
                                ?>
                                </div>
                                <?php
                                    }
                                ?>
                                

<!--                                <div class="form-group">
                                    <label for="exampleInputEmail1">Operation F2: <span
                                            class="required">*</span> </label>
                                    <?php
                                           if (!empty($parts->OperationF2)) {
                                               echo $parts->OperationF2;
                                           }
                                           else
                                           {
                                            echo "N/A";
                                           }
                                           ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Operation F3: <span
                                            class="required">*</span> </label>
                                    <?php
                                           if (!empty($parts->OperationF3)) {
                                               echo $parts->OperationF3;
                                           }
                                           else
                                           {
                                            echo "N/A";
                                           }
                                           ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Operation F4: <span
                                            class="required">*</span> </label>
                                    <?php
                                           if (!empty($parts->OperationF4)) {
                                               echo $parts->OperationF4;
                                           }
                                           else
                                           {
                                            echo "N/A";
                                           }
                                           ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Operation F5: <span
                                            class="required">*</span> </label>
                                    <?php
                                           if (!empty($parts->OperationF5)) {
                                               echo $parts->OperationF5;
                                           }
                                           else
                                           {
                                            echo "N/A";
                                           }
                                           ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Operation F6: <span
                                            class="required">*</span> </label>
                                   <?php
                                           if (!empty($parts->OperationF6)) {
                                               echo $parts->OperationF6;
                                           }
                                           else
                                           {
                                            echo "N/A";
                                           }
                                           ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Operation F7: <span
                                            class="required">*</span> </label>
                                    <?php
                                           if (!empty($parts->OperationF7)) {
                                               echo $parts->OperationF7;
                                           }
                                           else
                                           {
                                            echo "N/A";
                                           }
                                           ?>
                                </div>-->

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Issue:</label>
                                   <?php
                                           if (!empty($parts->Issue)) {
                                               echo $parts->Issue;
                                           }
                                           else
                                           {
                                            echo "N/A";
                                           }
                                           ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Notes:</label>
                                    <textarea name="Notes" readonly class="form-control autogrow" id="ck_editor"
                                              placeholder="Notes"><?php
                                        if (!empty($parts->Notes)) {
                                            echo $parts->Notes;
                                        }
										else
										{
										echo "N/A";
										}
                                        ?></textarea>
                                </div>


                            </div>
                            <!-- /.box-body -->
                        </div>
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