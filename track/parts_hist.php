<div class="form-group row">
	
	<table id="addAnother" style="margin-left: 40px;">
		<tr>
			<th style="text-align: center;">
				Parts
			</th>
			<th style="text-align: center;">
				Quantity
			</th>
		</tr>

		<?php

			$sql = "select * from td_parts_trans
                	where trans_type = 'O'
                	and   bill_no    = $trans_cd
                	and   sl_no      = '$sl_no'";

            $result = mysqli_query($db,$sql);

			$i = 0;

			while($data1 = mysqli_fetch_array($result,MYSQLI_NUM)){ $i++;  

					$select = "select sl_no,parts_desc from md_parts where sl_no = $data1[6]";
                   
        			$result1   = mysqli_query($db,$select);

        			//$parts    = mysqli_fetch_assoc($result);

        			//echo $parts['parts_desc'];


		?>

		<tr>
			<td><select class="form-control required" name="comp_sl_no[]">
					<option value="">Select Parts</option>?>

					<?php
						while($data = mysqli_fetch_assoc($result1)){ ?>
							<option value="<?php echo $data['sl_no'];?>"
								<?php echo($data['sl_no']==$data1[6])?'selected':'';?>>
								<?php echo $data['parts_desc']?>
							</option>	
					<?php	   	 
						   }
					?>

					
				</select>
			</td>

			<td><input type="text" name="comp_qty[]" class="form-control" value="<?php echo abs($data1[8]);  ?>" readonly></td>
		</tr>	


		<?php
				}
			?>
	</table>
</div>