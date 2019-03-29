<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add New Testimonial</h6>
                        <div id="widget_tab">
              				<ul>
               					 <li><a href="#tab1" class="active_tab">Content</a></li>
               					 <!--<li><a href="#tab2">SEO</a></li>-->
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'commentForm');
						echo form_open('admin/testimonials/insertEditTestimonials',$attributes) 
					?> 		
                    	<div id="tab1">
	 						<ul>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="testimonials_name">Testimonial Title <span class="req">*</span></label>
									<div class="form_input">
                                    <input name="title" style=" width:295px" id="title" value="" type="text" tabindex="1" class="required tipTop" title="Please enter the testimonial title"/>
									</div>
								</div>
								</li>
                               
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="description">Description</label>
                    <div class="form_input">
                      <textarea name="description" id="description" tabindex="3" class="large tipTop" title="Please enter the description"></textarea>
                    </div>
                  </div>
                </li>
              </ul>
             <ul><li><div class="form_grid_12">
				<div class="form_input">
                <input type="hidden" name="status" value="Active"  />
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
$this->load->view('admin/templates/footer.php');
?>