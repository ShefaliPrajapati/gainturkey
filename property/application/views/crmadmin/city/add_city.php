<?php
$this->load->view('crmadmin/templates/header.php');
?>
<style>
.uploader{
	overflow:visible !important;
}
.uploader label.error{
	left: 200px;
    position: absolute;
    width: 150px;
}
</style>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add New City</h6>
                        <div id="widget_tab">
              				<ul>
               					 <li><a href="#tab1" class="active_tab">Content</a></li>
               					 <li><a href="#tab2">SEO</a></li>
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'commentForm','enctype' => 'multipart/form-data');
						echo form_open('crmadmin/city/insertEditcity',$attributes) 
					?> 		
                    	<div id="tab1">
	 						<ul>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="name">City Name<span class="req">*</span></label>
									<div class="form_input">
                                    <input name="name" style=" width:295px" id="name" type="text" tabindex="1" class="required tipTop" title="Please enter the city name"/>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="stateid">State Name</label>
									<div class="form_input">
                                    <select class="required chzn-select" name="stateid" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Please select the state name">
                                            
                                            <?php foreach ($stateDisplay as $row){
											
											
											?>
                                            <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                                            <?php }?>
                                      </select>
                                    
                                    
                                    
                                    
                                    <!--<input name="stateid" style=" width:295px" id="stateid" type="text" tabindex="1" class="required tipTop" title="Please enter the state name"/>
									</div>
								</div>
								</li>
                                
                              <!--  <li>
								<div class="form_grid_12">
									<label class="field_title" for="citylogo">Logo<span class="req">*</span></label>
									<div class="form_input">
                                    <input name="citylogo" id="citylogo" type="file" tabindex="5" class="required large tipTop" title="Please select the logo image"/>
									</div>
								</div>
								</li>
                                
                                
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="citythumb">Thumbnail<span class="req">*</span></label>
									<div class="form_input">
                                   <input name="citythumb" id="citythumb" type="file" tabindex="5" class="required large tipTop" title="Please select the thumb image"/>
									</div>
								</div>
								</li>
                                
                               
                                <li>
                                  <div class="form_grid_12">
                                    <label class="field_title" for="description">Description</label>
                                    <div class="form_input">
                                      <textarea name="description" id="description" class="large tipTop mceEditor" title="Please enter the description"></textarea>
                                    </div>
                                  </div>
                                </li>-->
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status </label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" tabindex="8" name="status" checked="checked" id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								</li>
                               
								<input type="hidden" name="city_id" value=""/>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
									</div>
								</div>
								</li>
							</ul>
                        </div>
                        <div id="tab2">
              <ul>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_title">Meta Title</label>
                    <div class="form_input">
                      <input name="meta_title" id="meta_title" type="text" tabindex="1" class="large tipTop" title="Please enter the page meta title"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_tag">Meta Keyword</label>
                    <div class="form_input">
                      <textarea name="meta_keyword" id="meta_keyword"  tabindex="2" class="large tipTop" title="Please enter the page meta keyword"></textarea>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_description">Meta Description</label>
                    <div class="form_input">
                      <textarea name="meta_description" id="meta_description" tabindex="3" class="large tipTop" title="Please enter the meta description"></textarea>
                    </div>
                  </div>
                </li>
              </ul>
             <ul><li><div class="form_grid_12">
				<div class="form_input">
					<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
				</div>
			</div></li></ul>
			</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('crmadmin/templates/footer.php');
?>