<div class="form-group row">
	
	<table id="addAnother" style="margin-left: 40px;">
		<tr>
			<th style="text-align: center;">
				Serial No.
			</th>
			<th style="text-align: center;">
				Problem
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

			<td><input type = "text" name="prob[]" 
				       class= "form-control" 
				       value="<?php 
				       			    while($data = mysqli_fetch_assoc($result1)){
				       			   		  echo $data['problem_desc'];}
				       		  ?>" readonly>
			</td>	

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
	</table>
</div>