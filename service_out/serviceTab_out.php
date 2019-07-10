<div class="form-group row">
	
	<table id="addAnother" class= "table" style="margin-left: 10px;">
		<thead>
		<tr>
			<th style="text-align: center;">
				Serial No.
			</th>
			<!--<th style="text-align: center;">
				Problem
			</th>-->
			<th style="text-align: center;">
			</th>
			<th style="text-align: center;">
				Service On
			</th>
			<th style="text-align: center;">
				Technician
			</th>
			<th style="text-align: center;">
				Status
			</th>
			<th style="text-align: center;">
				Option
			</th>
		</tr>
	</thead>
	<tbody class="tbody">

		<?php

			$sql = "select * from td_mc_trans
                	where trans_type 	   = 'S'
                	and   trans_dt   	   = '$trans_dt'
                	and   trans_cd   	   = $trans_cd
                	and   approval_status  = 'U'
                	order by sl_no";

            $result = mysqli_query($db,$sql);

			$i = 0;

			while($data1 = mysqli_fetch_array($result,MYSQLI_NUM)){ $i++;  
/////////////
			 $problem    = "select * from md_problem where sl_no = $data1[6]";
			 $result1    = mysqli_query($db,$problem);

/////////////
			 $engg       = "select * from md_tech where emp_code = $data1[12]";
			 $result2    = mysqli_query($db,$engg);

             
		?>

		<tr>
			<td><input type = "text" name="sl_no[]" 
				       class= "form-control" value="<?php echo $data1[5];?>" readonly>
			</td>

			<!--<td><input type = "text" name="prob[]" 
				       class= "form-control" 
				       value="<?php 
				       			    //while($data = mysqli_fetch_assoc($result1)){
				       			   		  //echo $data['problem_desc'];}
				       		  ?>" readonly>
			</td>-->	

			<!--<td><a href="http://www.synergicsoftek.in/">redirect</a></td>-->

			<td><button type="button" data-toggle="modal" class="trigger" id="<?php echo $data1[5];?>" data-target="#myModal">Details</button></td>

			<td><input type = "text" name="transdt" 
				       class= "form-control" value="<?php echo date('d/m/Y',strtotime($trans_dt));?>" readonly>
			</td>

			<td><input type = "text" name="tech[]" 
				       class= "form-control" value="<?php  
				        							      while($data = mysqli_fetch_assoc($result2)){
				        							       		echo $data['tech_name'];} 
				        							?>"  readonly>
			</td>

			<td><input type = "text" name="status[]" 
				       class= "form-control" value="<?php if($data1[7]=='I'){
				       										 echo 'In Warranty';
				       									  }else{
				       									     echo 'Out of Warranty';		
				       									  }?>" readonly>
			</td>

			<td><input type="checkbox" name="out[]" class="form-control" value="<?php echo $data1[5];?>"></td>
		</tr>	


		<?php
				}
			?>
	</tbody>
	</table>
<!--------------------------------------------------------------->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Parts Details</h4>
        </div>
        <div class="modal-body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>


<!---------------------------------------------------------------->


</div>

<script>

	$('.trigger').click(function(){

		$.get('./viewDtls.php', {

			mcSlNo: $(this).attr('id'),
			tktNo: $('#trans_cd').val()

		}).done(function(result){

			var string = '';
			count = 0;
			var data = JSON.parse(result);

			for(var i=0; i < data.parts_desc.length; i++){
				 string += "Part's Name: "+data.parts_desc[i]+" Quantity: "+data.comp_qty[i]+"<br>";
			}	
			
			$('.modal-body').html(string);
			
		});

	})

</script>
