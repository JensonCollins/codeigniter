
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel"><?php echo $storage->product_name ?></h4>
</div>
<div class="modal-body wrap-modal wrap" style="max-height: 900px;">

    <div class="row">
        <div class="col-sm-6 col-md-8">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="active" colspan="2"><?php echo $storage->product_name ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="col-sm-3">Product Code</td>
                    <td><?php echo $storage->product_code ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3 ">Product Name</td>
                    <td class=""><?php echo $storage->product_name ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3">Product Size</td>
                    <td><?php echo $storage->product_size ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3 ">Product Category</td>
                    <td class=""><?php echo $storage->category_name ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3 ">Product SubCategory</td>
                    <td class=""><?php echo $storage->subcategory_name ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3">Product Quantity</td>
                    <td class=""><?php echo $storage->product_quantity ?></td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>


    <div class="modal-footer" >

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <!-- <a href="<?php echo base_url(); ?>admin/storage/new_storage/<?php echo $storage_id ?>" type="button" class="btn btn-primary">Edit Product</a> -->

        </div>

</div>


