<?php
		$select = "select mc_id,mc_type from md_mc_type";
                   
        $device  = mysqli_query($db,$select);

?>

<div class="form-group row">
	
	<table id="addAnother" style="margin-left: 30px;">
		<tr>
			<th style="text-align: center;">
				Device Name
			</th>
			<th style="text-align:center;">
				Quantity
			</th>
			<th style="text-align:center;">
				Sl.From
			</th>
			<th style="text-align:center;">
				Sl.To
			</th>
		</tr>
		

			<?php
                
                $i=0;
                  
                while($data1 = mysqli_fetch_array($result1, MYSQLI_NUM)){ $i++;
                  			
                  			$sql = "select mc_id, mc_type from md_mc_type where mc_id = $data1[6]";

        					$slno  = mysqli_query($db,$sql);
        					
        					$sl_no = mysqli_fetch_assoc($slno);

        					$sql1 = "select sl_no_from,sl_no_to from td_device_trans where trans_dt='$trans_dt'and trans_no = $transNo and mc_type=$data1[6]";

        					$query = mysqli_query($db,$sql1);
        					$slDev = mysqli_fetch_assoc($query);

                  	?>
		    
					<tr>

						<td><select class="form-control required blkSelected" name="dev_name[]" >
							
							   		<option value="<?php echo $sl_no['mc_id'] ?>"><?php 

							   		echo $sl_no['mc_type']?>
							   			
							   		</option>
							</select>

						</td>

						<td><input type="number"  min="1" 
								   name="c_qty[]" id="c_qty" 
								   class="form-control"
								   style="text-align:center;"		
								   value = <?php echo abs($data1[8]); ?>
								   required>
						</td>

						<td><input type="number" min="1" 
								   name="c_slfrm[]" id="c_slfrm" 
								   class="form-control"
								   style="text-align:center;"		
								   value = <?php echo $data1[14]; ?>
								   required>
						</td>

						<td><input type="number" min="1"  
								   name="c_slto[]" id="c_slto" 
								   class="form-control"
								   style="text-align:center;"		
								   value = <?php echo $data1[15]; ?>
								   required>
						</td>

					</tr>

			<?php
				}
			?>
			
	</table>
</div>