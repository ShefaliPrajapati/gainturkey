jQuery(document).ready(function(e)
 {
	jQuery('.location').keyup(function()
	{
		var text = jQuery(this).val();
		jQuery.ajax(
		{
			url: jQuery('#base_url').val()+'search/search_text',
			data: 'text='+text,
			type: 'POST',
			success: function(data)
			{
				jQuery('.for_auto_search').html(data);
				jQuery('.for_auto_complete_text').click(function()
				{
					jQuery('.location').val(jQuery(this).text());
					jQuery(this).parent('ul').hide();
					jQuery('#location_val').hide();
				}
				);
			}
		}
		);
	});
});