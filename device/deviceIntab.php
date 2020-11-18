<?php
		$select = "select mc_id,mc_type from md_mc_type";
                   
        $device  = mysqli_query($db,$select);
?>

<div class="form-group row">

    <div class="col-sm-10">
        <button type="button" id=addRow class="subbtn addbtn">
            <i class="fa fa-plus-square-o fa-2x" aria-hidden="true"></i>
        </button>
    </div>
</div>

<div class="form-group row">
	
	<table id="addAnother" style="margin-left:30px;">
		<tr>
			<th style="text-align: center;">
				Device Name
			</th>
			<th style="text-align:center;">
				Quantity
			</th>
			<!--<th style="text-align:center;">
				Sl.From
			</th>
			<th style="text-align:center;">
				Sl.To
			</th>-->
		</tr>
		<tr>

			<td><select class="form-control required blkSelected" name="dev_name[]">
					<option value="">Select Device</option>?>
					<?php 
						   while($data = mysqli_fetch_assoc($device)){
						   		echo ("<option value=".$data['mc_id'].">".$data['mc_type']."</option>");
						   }
					?>
				</select>
			</td>
			<td><input type="number" min="1" 
					   name="c_qty[]" id="c_qty" 
					   style="text-align:center;"
					   class="form-control"	
					   required >
			</td>
			<!--<td><input type="number" min="1" 
					   name="c_slfrm[]" id="c_slfrm" 
					   style="text-align:center;"
					   class="form-control"			
					   value=0
					   >
			</td>
			<td><input type="number" min="1" 
					   name="c_slto[]" id="c_slto" 
					   style="text-align:center;"
					   class="form-control"	
					   value=0		
					   >
			</td>-->
			
		</tr>	
	</table>
</div>
 
<script>

$(document).ready(function(){

	$('#addRow').click(function(){

		$('#addAnother').append('<tr><td><select class="form-control required blkSelected" name="dev_name[]"><option value="">Select Device</option><?php $select = "select mc_id,mc_type from md_mc_type"; $device  = mysqli_query($db,$select);while($data = mysqli_fetch_assoc($device)){echo ("<option value=".$data['mc_id'].">".$data['mc_type']."</option>");}?></select></td><td><input type="number" min="1"name="c_qty[]" id="c_qty"style="text-align:center;"class="form-control"required></td><!--<td><input type="text" name="c_slfrm[]" id="c_slfrm" style="text-align:center; class="form-control" value=0></td><td><input type="text" name="c_slto[]" id="c_slto" style="text-align:center;"class="form-control"value=0></td>--><td><button class="removeRow removebtn" type="button" ><i class="fa fa-times" aria-hidden="true"></i></button></td></tr>');
		     $('.blkSelected').change();

	});

	$('#addAnother').on('click', '.removeRow', function(){
		 $(this).parent().parent().remove();
	});

	$('#addAnother').on('change', '.blkSelected', function(){
		$('.blkSelected').each(function(){
			$('.blkSelected').find('option[value ="' + this.value + '"]').attr("disabled", true);
		});
	});

	$('#subbtn').click( function(){

		$('.blkSelected').each(function(){
			$('.blkSelected').find('option[value ="' + this.value + '"]').attr("disabled", false);
		});
		$('#subbtn').prop('type', 'submit');
	});
});
</script>