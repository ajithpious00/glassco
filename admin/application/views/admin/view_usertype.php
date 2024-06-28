
<div class="form-group">
                        <label for="Usertype">User Type</label>
                       <select name="usertype" id="usertype" class="form-control">
							<option value="">Select</option>
							<?php
						  foreach($h->result() as $row)
						  {
						     ?>
							
							<option value="<?php echo $row->ID;?>"><?php echo $row->Type;?></option>
							
							<?php
						  }
						  ?>
					   </select>
</div>
                     <div class="form-group" id="saleArea" style='display:none;'>
                        <label for="executiveSaleArea">City/Area of Sale</label>
                        <input type="text" class="form-control" id="executiveSaleArea" name="executiveSaleArea" placeholder="Enter the Area of Sale">
                      </div>
                      <!--<div class="form-group">
                        <label for="exampleTextarea1">Textarea</label>
                        <textarea class="form-control" id="exampleTextarea1" rows="4"></textarea>
                      </div>-->
                      <button type="button" class="btn btn-primary mr-2" name="saveUser" id="saveUser">Save</button>
                      <a href="<?php echo base_url(); ?>admin/forms"><button type="button" class="btn btn-light" name="cancelUser" id="cancelUser">Cancel</button></a>


