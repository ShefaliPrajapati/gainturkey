jQuery(document).ready(function(e)
 {
	jQuery('.general_search').keyup(function()
	{
		var text = jQuery(this).val();
		jQuery.ajax(
		{
			url: jQuery('#base_url').val()+'search/search_general',
			data: 'text='+text,
			type: 'POST',
			success: function(data)
			{
				jQuery('.for_general_search').html(data);
				jQuery('.for_general_complete_text').click(function()
				{
					jQuery('.general_search').val(jQuery(this).text());
					jQuery(this).parent('ul').hide();
				}
				);
			}
		}
		);
	});
});