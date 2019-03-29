jQuery(document).ready(function(e)
 {
	jQuery('.userMail').keyup(function()
	{
		var text = jQuery(this).val();
		jQuery.ajax(
		{
			url: baseURL+'search/search_text',
			
			data: 'text='+text,
			type: 'POST',
			success: function(data)
			{
				jQuery('.for_auto_search').html(data);
				jQuery('.for_auto_complete_text').click(function()
				{
					jQuery('.userMail').val(jQuery(this).text());
					jQuery(this).parent('ul').hide();
					jQuery('#userMail_val').hide();
				}
				);
			}
		}
		);
	});
});