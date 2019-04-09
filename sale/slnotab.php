
<div class="form-group row">

    <div class="col-sm-10">
        <button type="button" id=addRow class="subbtn addbtn">
            <i class="fa fa-plus-square-o fa-2x" aria-hidden="true"></i>
        </button>
    </div>
</div>

<div class="form-group row">
	
	<table id="addAnother" style="margin-left: 115px;">
		<tr>
			<th style="text-align:center;">
				Sl.No.
			</th>
		</tr>
		<tr>
			<td><input type="number" min="1" 
					   name="c_sl[]" id="c_sl" 
					   style="text-align:center;"
					   class="form-control"			
					   >
			</td>
			
		</tr>	
	</table>
</div>
 
<script>

$(document).ready(function(){

	$('#addRow').click(function(){

		$('#addAnother').append('<tr><td><input type="number" min="1"name="c_sl[]" id="c_sl"style="text-align:center;"class="form-control"required></td><td><button class="removeRow removebtn" type="button" ><i class="fa fa-times" aria-hidden="true"></i></button></td></tr>');
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