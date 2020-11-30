<!-- View message -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<section class="content">
	<div class="row">
		<div class="col-md-12">

			<div class="box box-primary">
				<div class="box-header box-header-background with-border">
					<div class="col-md-offset-3">
						<h3 class="box-title ">Add Parts</h3>
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

						<div class="col-md-12 col-sm-12 col-xs-12">

							<div class="box-body">
								<div class="row">
									<div class="col-md-4 col-sm-4 col-xs-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Part # <span
														class="required">*</span></label>
											<input type="text" name="PartNo" placeholder="Part Number"
												   value="<?php
												   if (!empty($parts->PartNo)) {
													   echo htmlspecialchars($parts->PartNo);
												   }
												   ?>"
												   class="form-control">
										</div>
									</div>
									<div class="col-md-4 col-sm-4 col-xs-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Description<span
														class="required">*</span></label>
											<input type="text" name="Description" placeholder="Description"
												   value="<?php
												   if (!empty($parts->Description)) {
													   echo htmlspecialchars($parts->Description);
												   }
												   ?>"
												   class="form-control">
										</div>
									</div>

									<div class="col-md-4 col-sm-4 col-xs-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Customer <span
														class="required">*</span></label>
											<input type="text" placeholder="Customer" name="Customer"
												   value="<?php
												   if (!empty($parts->Customer)) {
													   echo htmlspecialchars($parts->Customer);
												   }
												   ?>"
												   class="form-control">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4 col-sm-4 col-xs-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Price <span
														class="required">*</span></label>
											<input type="text" placeholder="Price" name="Price"
												   value="<?php
												   if (!empty($parts->Price)) {
													   echo htmlspecialchars($parts->Price);
												   }
												   ?>"
												   class="form-control">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-sm-4 col-xs-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Material <span
														class="required">*</span></label>
											<input type="text" placeholder="Material" name="Material"
												   value="<?php
												   if (!empty($parts->Material)) {
													   echo htmlspecialchars($parts->Material);
												   }
												   ?>"
												   class="form-control">
										</div>
									</div>

									<div class="col-md-4 col-sm-4 col-xs-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Material Description <span
														class="required">*</span></label>
											<input type="text" placeholder="Material Description" name="MatDescription"
												   value="<?php
												   if (!empty($parts->MatDescription)) {
													   echo htmlspecialchars($parts->MatDescription);
												   }
												   ?>"
												   class="form-control">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="form-group">
											<label for="exampleInputEmail1">Treatment <!-- <span
                                            class="required">*</span> --></label>
											<input type="text" placeholder="Treatment" name="Treatment"
												   value="<?php
												   if (!empty($parts->Treatment)) {
													   echo htmlspecialchars($parts->Treatment);
												   }
												   ?>"
												   class="form-control">
										</div>
									</div>

									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="form-group">
											<label for="exampleInputEmail1">Treatment Cost <!-- <span
                                            class="required">*</span> --></label>
											<input type="text" placeholder="TreatmentCost" name="TreatmentCost"
												   value="<?php
												   if (!empty($parts->TreatmentCost)) {
													   echo htmlspecialchars($parts->TreatmentCost);
												   }
												   ?>"
												   class="form-control">
										</div>
									</div>
								</div>

								<div class="row">

									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="form-group">
											<label for="exampleInputEmail1">Operation F1<span
														class="required">*</span></label>
											<input type="text" placeholder="OperationF1" name="OperationF1"
												   value="<?php
												   if (!empty($parts->OperationF1)) {
													   echo htmlspecialchars($parts->OperationF1);
												   }
												   ?>"
												   class="form-control">
										</div>
									</div>

									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="form-group">
											<label for="exampleInputEmail1">Operation F2<!-- <span
                                            class="required">*</span> --></label>
											<input type="text" placeholder="OperationF2" name="OperationF2"
												   value="<?php
												   if (!empty($parts->OperationF2)) {
													   echo htmlspecialchars($parts->OperationF2);
												   }
												   ?>"
												   class="form-control">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="form-group">
											<label for="exampleInputEmail1">Operation F3<!-- <span
                                            class="required">*</span> --></label>
											<input type="text" placeholder="OperationF3" name="OperationF3"
												   value="<?php
												   if (!empty($parts->OperationF3)) {
													   echo htmlspecialchars($parts->OperationF3);
												   }
												   ?>"
												   class="form-control">
										</div>
									</div>

									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="form-group">
											<label for="exampleInputEmail1">Operation F4<!-- <span
                                            class="required">*</span> --></label>
											<input type="text" placeholder="OperationF4" name="OperationF4"
												   value="<?php
												   if (!empty($parts->OperationF4)) {
													   echo htmlspecialchars($parts->OperationF4);
												   }
												   ?>"
												   class="form-control">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="form-group">
											<label for="exampleInputEmail1">Operation F5<!-- <span
                                            class="required">*</span> --></label>
											<input type="text" placeholder="OperationF5" name="OperationF5"
												   value="<?php
												   if (!empty($parts->OperationF5)) {
													   echo htmlspecialchars($parts->OperationF5);
												   }
												   ?>"
												   class="form-control">
										</div>
									</div>

									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="form-group">
											<label for="exampleInputEmail1">Operation F6<!-- <span
                                            class="required">*</span> --></label>
											<input type="text" placeholder="OperationF6" name="OperationF6"
												   value="<?php
												   if (!empty($parts->OperationF6)) {
													   echo htmlspecialchars($parts->OperationF6);
												   }
												   ?>"
												   class="form-control">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="form-group">
											<label for="exampleInputEmail1">Operation F7<!-- <span
                                            class="required">*</span> --></label>
											<input type="text" placeholder="OperationF7" name="OperationF7"
												   value="<?php
												   if (!empty($parts->OperationF7)) {
													   echo htmlspecialchars($parts->OperationF7);
												   }
												   ?>"
												   class="form-control">
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="form-group">
											<label for="exampleInputEmail1">Operation F8<!-- <span
                                            class="required">*</span> --></label>
											<input type="text" placeholder="OperationF8" name="OperationF8"
												   value="<?php
												   if (!empty($parts->OperationF8)) {
													   echo htmlspecialchars($parts->OperationF8);
												   }
												   ?>"
												   class="form-control">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="form-group">
											<label for="exampleInputEmail1">Operation F9<!-- <span
                                            class="required">*</span> --></label>
											<input type="text" placeholder="OperationF9" name="OperationF9"
												   value="<?php
												   if (!empty($parts->OperationF9)) {
													   echo htmlspecialchars($parts->OperationF9);
												   }
												   ?>"
												   class="form-control">
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="form-group">
											<label for="exampleInputEmail1">Operation F10<!-- <span
                                            class="required">*</span> --></label>
											<input type="text" placeholder="OperationF10" name="OperationF10"
												   value="<?php
												   if (!empty($parts->OperationF10)) {
													   echo htmlspecialchars($parts->OperationF10);
												   }
												   ?>"
												   class="form-control">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="form-group">

											<label for="exampleInputEmail1">Issue<span
														class="required">*</span></label>
											<input type="text" placeholder="Issue" name="Issue"
												   value="<?php
												   if (!empty($parts->Issue)) {
													   echo htmlspecialchars($parts->Issue);
												   }
												   ?>"
												   class="form-control">
										</div>
									</div>
								</div>

								<div class="form-group">
									<label for="exampleInputEmail1">Notes</label>
									<textarea name="Notes" class="form-control autogrow" id="ck_editor"
											  placeholder="Notes"><?php
										if (!empty($parts->Notes)) {
											echo $parts->Notes;
										}
										?></textarea>
									<?php echo display_ckeditor($editor['ckeditor']); ?>
								</div>


							</div>
							<!-- /.box-body -->
						</div>
					</div>

					<!-- customer id -->
					<input type="hidden" name="id" value="<?php if (!empty($parts->id)) {
						echo $parts->id;
					} ?>" id="id">

					<div class="box-footer">
						<button type="submit" id="customer_btn" class="btn bg-navy col-md-offset-3" type="submit">Create
							Parts
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

<script src="<?php echo base_url() ?>asset/js/ajax.js"></script>
