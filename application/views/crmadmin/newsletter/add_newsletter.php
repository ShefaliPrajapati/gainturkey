<?php
$this->load->view('crmadmin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add Email Template</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'commentForm');
						echo form_open('crmadmin/newsletter/insertEditNewsletter',$attributes) 
					?>
	 						<ul>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="news_title">Template Name <span class="req">*</span></label>
									<div class="form_input">
                                    <input name="news_title" style=" width:295px" id="news_title" value="" type="text" tabindex="1" class="required tipTop" title="Please enter the email templete name"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="news_subject">Email Subject <span class="req">*</span></label>
									<div class="form_input">
                                    <input name="news_subject" style=" width:295px" id="news_subject" type="text" tabindex="1" class="required tipTop" title="Please enter the email templete subject"/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="sender_name">Sender Name <span class="req">*</span></label>
									<div class="form_input">
                                    <input name="sender_name" style=" width:295px" id="sender_name" type="text" tabindex="1" value="<?php echo $this->data['title'];?>" class="required tipTop" title="Please enter the sender name"/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="sender_email">Sender Email Address <span class="req">*</span></label>
									<div class="form_input">
                                    <input name="sender_email" style=" width:295px" id="sender_email" type="text" tabindex="1" value="<?php echo $this->config->item('email');?>" class="required tipTop" title="Please enter the sender email address"/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="news_descrip">Email Description  </label>
									<div class="form_input">
                                    <textarea name="news_descrip" style=" width:295px" class="tipTop mceEditor" title="Please enter the email templete description"></textarea>
									</div>
								</div>
								</li>
                                <input type="hidden" name="status" id="status" />
								<input type="hidden" name="newsletter_id" value=""/>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
									</div>
								</div>
								</li>
							</ul>
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