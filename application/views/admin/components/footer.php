 
<footer class="main-footer">
        <strong>Copyright &copy; <?php echo date("Y") ?> <a href="http://bedfordengineering.co.uk" target="_blank">Bedford Engineering Ltd</a>.</strong> All rights reserved.
      </footer>
      
 </div><!-- ./wrapper -->

<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>asset/js/bootstrap.min.js" type="text/javascript"></script>
<!--<script src="--><?php //echo base_url(); ?><!--asset/js/menu.js" type="text/javascript"></script>-->
<!--<script src="--><?php //echo base_url(); ?><!--asset/js/custom-validation.js" type="text/javascript"></script>-->
<script src="<?php echo base_url(); ?>asset/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/js/app.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/js/form-validation.js" type="text/javascript"></script>
<!-- Jasny Bootstrap for NIce Image Change -->
<script src="<?php echo base_url() ?>asset/js/jasny-bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>asset/js/bootstrap-datepicker.js" ></script>
<script src="<?php echo base_url() ?>asset/js/timepicker.js" ></script>
<!-- Data Table -->
<!--<script src="--><?php //echo base_url(); ?><!--asset/js/plugins/metisMenu/metisMenu.min.js" type="text/javascript"></script>-->
<script src="<?php echo base_url(); ?>asset/js/plugins/dataTables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/js/plugins/dataTables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/js/chartjs/Chart.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/js/chartjs/dashboard.js" type="text/javascript"></script>


    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
        $('#dataTables-example1').dataTable({"aaSorting": [ [0,'desc'] ]});
        $(".select2").select2();
    });

    function clearSelection(id) {    
    	 $("#"+id).select2().val(null).trigger("change");
	}

    $(function() {
        var max_fields = 10; //maximum input boxes allowed
        var x = 1; //initlal text box count
        
        $('#add_parts').click(function () {
//            if(x < max_fields){
                x++;
				var ref = $(".add-parts-clone").first();
				$(ref).find('span.select2.select2-container').remove();
				$(ref).find('select.select2').removeClass('select2-hidden-accessible');
				var new_part = $(ref).clone();
				setTimeout(function(){ $("select.select2").select2();}, 1000);
				$("#deceased").append('<div class="col-md-12 col-sm-12" id="deceased"><a href="#" class="remove_field" title="Remove" style="color: #000;">X</a>'+$(new_part).html()+'</div>');
//            }  else{
//                alert("Only 10 Upload Allowed");
//            }  
        });
        $('#add_parts_edit').click(function () {
//            if(x < max_fields){
                x++;                
                var ref = $(".add-parts-clone2").first();
                var new_part = $(ref).clone();
                new_part.find('span.select2.select2-container').remove();
                new_part.find('select.select2').removeClass('select2-hidden-accessible');
                new_part.find('.add-parts-clone2').removeClass('hide');
                new_part.find('.parts').attr('name','sel_parts2[]');
                new_part.find('.qty').attr('name','part_qty2[]');
                new_part.find('.mat_sup').attr('name','mat_supplier2[]');
                new_part.find('.mat_cost').attr('name','mat_cost2[]');
                new_part.find('.order_price').attr('name','order_price2[]');
                console.log(new_part);
                setTimeout(function(){ $("select.select2").select2();}, 1000);
                $("#deceased").append('<div class="col-md-12 col-sm-12" id="deceased"><a href="#" class="remove_field" title="Remove" style="color: #000;">X</a>'+$(new_part).html()+'</div>');
                    
//            }  else{
//                alert("Only 10 Upload Allowed");
//            }  
        });
//        $('#add_parts_edit').click(function () {
//            if(x < max_fields){
//                x++;                
//                var ref = $(".add-parts-clone2").first();
//                $(ref).find('.add-parts-clone2').removeClass('hide');
//                $(ref).find('span.select2.select2-container').remove();
//                $(ref).find('select.select2').removeClass('select2-hidden-accessible');
//                var new_part = $(ref).clone();
//                setTimeout(function(){ $("select.select2").select2();}, 1000);
//                $("#deceased").append('<div class="col-md-12 col-sm-12" id="deceased"><a href="#" class="remove_field" title="Remove" style="color: #000;">X</a>'+$(new_part).html()+'</div>');
//                    
//            }  else{
//                alert("Only 10 Upload Allowed");
//            }  
//        });


        $(document).on('click', '.remove_field', function(e){
                e.preventDefault(); 
            $(this).parent('div').remove(); 
            x--;
        });
    });
    </script>




</body>
</html>
