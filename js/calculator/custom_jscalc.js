// JavaScript Document

$(document).ready(function()
{
																   
	
	$('#openPopUp').click(function()
	{
		$('.calculatorPopUp').css('display','block');
	});
	
		$('#openPopUp1').click(function()
		{

		$('.calculatorPopUps').css('display','block');
		});
		
	$('#popUpClose').live('click',function()
	{
		
			$(':input','#frm')
			.not(':button, :submit, :reset, :hidden,#cur_value')
			.val('');
		$('.calculatorPopUp').css('display','');
	

	});
		$('#popUpClose1').live('click',function()
	{
		
	
		$('.calculatorPopUps').css('display','');
	

	});
	
	
});