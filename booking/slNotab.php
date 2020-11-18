<?php
		$select = "select sl_no,problem_desc from md_problem order by problem_desc";
                   
        $prob   = mysqli_query($db,$select);
?>

<div class="form-group row">

    <div class="col-sm-10">
        <button type="button" id=addRow class="subbtn addbtn">
            <i class="fa fa-plus-square-o fa-2x" aria-hidden="true"></i>
        </button>
    </div>
</div>

<div class="form-group row">
	
	<table id="addAnother" style="margin-left: 20px;">
		<tr>
			<th style="text-align: center;">
				Serial No.
			</th>
			<th style="text-align: center;">
				Problem
			</th>
			<th style="text-align: center;">
				Status
			</th>
		</tr>
		<tr>
			<td><input type="text" name="sl_no[]" class="form-control" required></td> 

			<td><select class="form-control required" name="prob[]">
					<option value="">Select Problem</option>?>
					<?php 
						   while($data = mysqli_fetch_assoc($prob)){
						   		echo ("<option value=".$data['sl_no'].">".$data['problem_desc']."</option>");
						   }
					?>
				</select>
			</td>
			<td><select name="status[]" id="status" class="form-control required">
					<option value="I">In Warranty</option>
					<option value="O">Out Warranty</option>
				</select>	
			</td>
			
		</tr>	
	</table>
</div>
 
<script>

$(document).ready(function(){

	$('#addRow').click(function(){

		$('#addAnother').append('<tr><td><input type="text" name="sl_no[]" class="form-control" required></td><td><select class="form-control required" name="prob[]"><option value="">Select Problem</option>?><?php $select = "select sl_no,problem_desc from md_problem";$prob   = mysqli_query($db,$select); while($data = mysqli_fetch_assoc($prob)){echo ("<option value=".$data['sl_no'].">".$data['problem_desc']."</option>");}?></select></td><td><select name="status[]" id="status" class="form-control required"><option value="I">In Warranty</option><option value="O">Out Warranty</option></select></td><td><button class="removeRow removebtn" type="button" ><i class="fa fa-times" aria-hidden="true"></i></button></td></tr>');
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