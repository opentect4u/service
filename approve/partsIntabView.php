<?php
		$select = "select sl_no,parts_desc from md_parts";
                   
        $parts  = mysqli_query($db,$select);
?>

<div class="form-group row">
	
	<table id="addAnother" style="margin-left: 115px;">
		<tr>
			<th style="text-align: center;">
			</th>

			<th style="text-align: center;">
				Component Name
			</th>
			<th style="text-align:center;">
				Quantity
			</th>
		</tr>
		

			<?php
                
                $i=0;
                  
                while($data1 = mysqli_fetch_array($result1, MYSQLI_NUM)){ $i++;
                  			
                  			$sql = "select sl_no, parts_desc from md_parts where sl_no = $data1[5]";

        					$slno  = mysqli_query($db,$sql);
        					
        					$sl_no = mysqli_fetch_assoc($slno);

                  	?>
		    
					<tr>

						<!--<td><select class="form-control required blkSelected" name="comp_name[]" >
							
							   		<option value="<?php echo $sl_no['sl_no'] ?>"><?php 

							   		echo $sl_no['parts_desc']?>
							   			
							   		</option>
							</select>

						</td>-->

						<td><input type="hidden"
								   name="comp_name[]"
								   class="form-control"		
								   value = <?php echo $sl_no['sl_no']; ?>
								   readonly>
						</td>


						<td><input type="text"
								   name="comp_name[]"
								   class="form-control"		
								   value = <?php echo $sl_no['parts_desc']; ?>
								   readonly>
						</td>

						<td><input type="number" min="1" 
								   name="c_qty[]" id="c_qty" 
								   class="form-control"
								   style="text-align:center;"		
								   value = <?php echo abs($data1[7]); ?>
								   readonly>
						</td>

						
					</tr>

			<?php
				}
			?>
			
	</table>
</div>